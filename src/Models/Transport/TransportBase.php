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
     * @param array $data
     * @return TransportInterface
     * @throws \Exception
     */
    public static function factory(array $data = [])
    {
        if ( empty($data['type']) ) {
            throw new \Exception("Type is required for Transport factory.");
        }

        // Let's do a little magic
        $className = 'Transport' . str_replace('_', '', ucwords($data['type'], '_'));
        $fullClassName = __NAMESPACE__ . '\\' . $className;

        if ( !class_exists($fullClassName) ) {
            throw new \Exception(sprintf("Class %s not found.", $fullClassName));
        }

        $instance =  new $fullClassName();

        // Calling all public setters (magic again)
        foreach ( $data as $key => $value ) {
            $method = 'set' . ucfirst($key);
            if ( method_exists($instance, $method) ) {
                call_user_func([$instance, $method], $value);
            }
        }

        return $instance;
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