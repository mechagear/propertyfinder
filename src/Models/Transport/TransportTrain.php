<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:06
 */

namespace Mechagear\PF\Models\Transport;


class TransportTrain extends TransportBase
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return "train";
    }
}