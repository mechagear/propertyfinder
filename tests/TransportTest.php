<?php

use PHPUnit\Framework\TestCase;
use Mechagear\PF\Models\Transport;

/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 03.08.17
 * Time: 1:21
 */
class TransportTest extends TestCase
{

    /**
     * Factory method test
     */
    public function testFactory()
    {
        $this->assertEquals(new Transport\TransportAirplane(), Transport\TransportBase::factory("airplane"));
        $this->assertEquals(new Transport\TransportAirportBus(), Transport\TransportBase::factory("airport_bus"));
        $this->assertEquals(new Transport\TransportTrain(), Transport\TransportBase::factory("train"));
        $this->assertEquals(new Transport\TransportBus(), Transport\TransportBase::factory("bus"));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionCode 801
     */
    public function testWrongFactory()
    {
        Transport\TransportBase::factory("non_existent_transport");
    }

}