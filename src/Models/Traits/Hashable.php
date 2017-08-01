<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 01.08.17
 * Time: 23:00
 */

namespace Mechagear\PF\Models\Traits;


trait Hashable
{
    abstract public function getHashCode(): string;
}