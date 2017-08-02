<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:05
 */

namespace Mechagear\PF\Models\Transport;


class TransportBus extends TransportBase
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return "a bus";
    }
}