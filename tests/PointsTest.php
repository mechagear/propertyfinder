<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 03.08.17
 * Time: 1:27
 */
class PointsTest extends TestCase
{

    /**
     * Kind of useless, but we will know when hash generation algorithm is changed.
     */
    public function testPointHash()
    {
        $point = new \Mechagear\PF\Models\Points\Point("test_point");
        $this->assertEquals("92c709ba12a2eac850b75a39cd1151f1", $point->getHashCode());
    }

}