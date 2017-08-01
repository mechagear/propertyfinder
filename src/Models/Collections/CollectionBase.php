<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 01.08.17
 * Time: 23:19
 */

namespace Mechagear\PF\Models\Collections;


abstract class CollectionBase implements CollectionInterface, \Iterator
{
    /**
     * @var int
     */
    protected $cursor = 0;

    /**
     * @var array
     */
    protected $collection = [];

    // Primitive Iterator implementation
    /**
     * Moves cursor to the next element
     */
    public function next()
    {
        ++$this->cursor;
    }

    /**
     * Returns true if element is exists
     * @return bool
     */
    public function valid()
    {
        return isset($this->collection[$this->cursor]);
    }

    /**
     * Returns current element
     * @return mixed
     */
    public function current()
    {
        return $this->collection[$this->cursor];
    }

    /**
     * Rewinds cursor
     */
    public function rewind()
    {
        $this->cursor = 0;
    }

    /**
     * Returns cursor value
     * @return int
     */
    public function key()
    {
        return $this->cursor;
    }

    /**
     * @param $element
     * @return CollectionInterface
     */
    public function add($element): CollectionInterface
    {
        $this->collection[] = $element;
        return $this;
    }

    /**
     * @param $element
     * @return CollectionInterface
     */
    public function remove($element): CollectionInterface
    {
        foreach ( $this->collection as $key => $value ) {
            if ( $value == $element ) {
                // If we deleting an element before cursor then we need decrement it.
                // Otherwise after keys resetting cursor will point to wrong element.
                if ( $key < $this->cursor ) {
                    --$this->cursor;
                }
                unset($this->collection[$key]);
            }
        }
        $this->collection = array_values($this->collection); // reset keys
        return $this;
    }
}