<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:00
 */

namespace Mechagear\PF\Models\Transport;

use Mechagear\PF\Helpers\CaseHelper;

/**
 * Class TransportBase
 * @package Mechagear\PF\Models\Transport
 */
abstract class TransportBase implements TransportInterface
{
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
        $className = 'Transport' . CaseHelper::camelize($type);
        $fullClassName = __NAMESPACE__ . '\\' . $className;

        if ( !class_exists($fullClassName) ) {
            throw new \Exception(sprintf("Class %s not found.", $fullClassName), 801);
        }

        return new $fullClassName();
    }
}