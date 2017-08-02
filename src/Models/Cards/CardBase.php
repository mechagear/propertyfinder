<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 22:18
 */

namespace Mechagear\PF\Models\Cards;

use Mechagear\PF\Models\Points\Point;
use Mechagear\PF\Models\Traits\Hashable;
use Mechagear\PF\Models\Transport\TransportInterface;

/**
 * Class CardBase
 * Implements common methods for all card types.
 * @package Mechagear\PF\Models\Cards
 */
abstract class CardBase implements CardInterface
{
    use Hashable;

    const BAGGAGE_UNKNOWN   = 0;
    const BAGGAGE_AUTO      = 1;
    const BAGGAGE_PLACE     = 2;

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
     * Gate number (optional)
     * @var string
     */
    protected $gate = '';

    /**
     * Seat number (optional)
     * @var string
     */
    protected $seatNumber = '';

    /**
     * Baggage delivery type (auto - auto transfer, place - dropzone, unknown - take by yourself e.t.c.)
     * @var int
     */
    protected $baggageType = self::BAGGAGE_UNKNOWN;

    /**
     * Baggage place number
     * @var string
     */
    protected $baggagePlace = '';

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
    public function getDeparture(): Point
    {
        return $this->departure;
    }

    /**
     * @return Point
     */
    public function getArrival(): Point
    {
        return $this->arrival;
    }

    /**
     * @return TransportInterface
     */
    public function getTransport(): TransportInterface
    {
        return $this->transport;
    }

    /**
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }

    /**
     * @param string $gate
     */
    public function setGate(string $gate)
    {
        $this->gate = $gate;
    }

    /**
     * @return string
     */
    public function getSeatNumber(): string
    {
        return $this->seatNumber;
    }

    /**
     * @param string $seatNumber
     * @return $this
     */
    public function setSeatNumber(string $seatNumber)
    {
        $this->seatNumber = $seatNumber;
        return $this;
    }

    /**
     * @return int
     */
    public function getBaggageType(): int
    {
        return $this->baggageType;
    }

    /**
     * @param int $baggageType
     * @return $this
     */
    public function setBaggageType(int $baggageType)
    {
        $this->baggageType = $baggageType;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaggagePlace(): string
    {
        return $this->baggagePlace;
    }

    /**
     * @param string $baggagePlace
     */
    public function setBaggagePlace(string $baggagePlace)
    {
        $this->baggagePlace = $baggagePlace;
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

    /**
     * @return string
     */
    public function __toString()
    {
        $templateString = "Take %s from %s to %s. ";

        if ( !empty($this->getGate()) && !empty($this->getSeatNumber()) ) {
            $seatGateString = sprintf("Gate %s, seat %s. ", $this->getGate(), $this->getSeatNumber());
        } elseif ( !empty($this->getSeatNumber()) ) {
            $seatGateString = sprintf("Sit in seat %s. ", $this->getSeatNumber());
        } else {
            $seatGateString = "No seat assignment. ";
        }

        $templateString .= $seatGateString;

        switch ( $this->baggageType ) {
            case self::BAGGAGE_AUTO:
                $templateString .= "Baggage will we automatically transferred from your last leg. ";
                break;
            case self::BAGGAGE_PLACE:
                $templateString .= sprintf("Baggage drop at ticket counter %s. ", $this->baggagePlace);
                break;
        }
        $resultStr = sprintf($templateString, $this->transport, $this->getDeparture(), $this->getArrival());
        return $resultStr;
    }
}