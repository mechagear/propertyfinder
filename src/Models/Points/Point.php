<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 22:36
 */

namespace Mechagear\PF\Models\Points;

use Mechagear\PF\Models\Traits\Hashable;

/**
 * Class Point
 * Describes arrival or departure point.
 * @package Mechagear\PF\Models
 */
class Point implements PointInterface
{
    use Hashable;
    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Only getter defined cause we shouldn't allow to change point's name cause hash depends on it.
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Separate method for getting a hash code required cause we can change hash code generation eventually.
     * @return string
     */
    public function getHashCode(): string
    {
        return md5($this->getName());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

}