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
     * Original collection remains unchanged because (maybe) we need collection in original state.
     * @return CollectionInterface
     */
    public function sorted(): CollectionInterface;

    public function add($element): CollectionInterface;

    public function remove($element): CollectionInterface;



}