<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:09
 */

namespace Mechagear\PF\Models\Transport;


class TransportAirportBus extends TransportBase
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return "the airport bus";
    }

}