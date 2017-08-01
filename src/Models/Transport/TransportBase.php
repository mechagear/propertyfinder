<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:00
 */

namespace Mechagear\PF\Models\Transport;


abstract class TransportBase implements TransportInterface
{
    /**
     * Seat number/code. By default - without seat reservation.
     * @var string
     */
    protected $seatCode = null;

    /**
     * @param string $type
     * @return TransportInterface
     * @throws \Exception
     */
    public static function factory(string $type): TransportInterface
    {
        if ( empty($type) ) {
            throw new \Exception("Type is required for Transport factory.");
        }

        // Let's do a little magic
        $className = 'Transport' . str_replace('_', '', ucwords($type, '_')); // primitive camelizer
        $fullClassName = __NAMESPACE__ . '\\' . $className;

        if ( !class_exists($fullClassName) ) {
            throw new \Exception(sprintf("Class %s not found.", $fullClassName));
        }

        return new $fullClassName();
    }

    /**
     * @return string
     */
    public function getSeatCode(): string
    {
        return $this->seatCode;
    }

    /**
     * @param string $seatCode
     * @return $this
     */
    public function setSeatCode(string $seatCode)
    {
        $this->seatCode = $seatCode;
        return $this;
    }


}