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
    public function __toString()
    {
        return "train";
    }
}