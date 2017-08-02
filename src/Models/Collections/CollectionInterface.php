<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 01.08.17
 * Time: 23:17
 */

namespace Mechagear\PF\Models\Collections;


interface CollectionInterface
{
    /**
     * Returns sorted copy of collection.
     * The sorting rules are defined by a concrete implementation.
     * Original collection remains unchanged because (maybe) we need collection in original state.
     * @return CollectionInterface
     */
    public function sorted(): CollectionInterface;

    /**
     * Adds element to collection
     * @param $element
     * @return CollectionInterface
     */
    public function add($element): CollectionInterface;

    /**
     * Removes element from collection
     * @param $element
     * @return CollectionInterface
     */
    public function remove($element): CollectionInterface;

    /**
     * @return string
     */
    public function __toString(): string;


}