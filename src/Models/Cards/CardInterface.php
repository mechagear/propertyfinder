<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 22:17
 */

namespace Mechagear\PF\Models\Cards;

use Mechagear\PF\Models\Points\Point;
use Mechagear\PF\Models\Transport\TransportInterface;

/**
 * Interface CardInterface
 * @package Mechagear\PF\Models\Cards
 */
interface CardInterface
{

    /**
     * CardInterface constructor.
     * Arrival & departure are mandatory, because we can't departure from nothing or arrive to nothing
     * @param Point $departure
     * @param Point $arrival
     * @param TransportInterface $transport
     */
    public function __construct(Point $departure, Point $arrival, TransportInterface $transport);

    /**
     * @return Point
     */
    public function getDeparture(): Point;

    /**
     * @return Point
     */
    public function getArrival(): Point;


    /**
     * @return string
     */
    public function __toString();

}