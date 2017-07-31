<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 22:18
 */

namespace Mechagear\PF\Models\Cards;

use Mechagear\PF\Models\Point;
use Mechagear\PF\Models\Transport\TransportInterface;

/**
 * Class CardBase
 * Implements common methods for all card types.
 * @package Mechagear\PF\Models\Cards
 */
abstract class CardBase implements CardInterface
{
    /**
     * @var Point
     */
    protected $departure;

    /**
     * @var Point
     */
    protected $arrival;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * CardBase constructor.
     * @param Point $departure
     * @param Point $arrival
     */
    public function __construct(Point $departure, Point $arrival, TransportInterface $transport)
    {
        $this->departure = $departure;
        $this->arrival = $arrival;
        $this->transport = $transport;
    }

    /**
     * @return Point
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * @return Point
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Common method for getting hash code for card.
     * Now we rely on departure hash code only.
     * @return string
     */
    public function getHashCode()
    {
        return $this->getDeparture()->getHashCode();
    }

    public function __toString()
    {
        $resultStr = sprintf("Take %s from %s to %s.", $this->transport, $this->getDeparture(), $this->getArrival());
        return $resultStr;
    }
}