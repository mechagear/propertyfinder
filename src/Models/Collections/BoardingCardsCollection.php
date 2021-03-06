<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 01.08.17
 * Time: 23:20
 */

namespace Mechagear\PF\Models\Collections;


use Mechagear\PF\Models\Cards\CardInterface;

class BoardingCardsCollection extends CollectionBase
{

    /**
     * Adds element to collection with an additional type check.
     * @param $element
     * @return CollectionInterface
     * @throws \Exception
     */
    public function add($element): CollectionInterface
    {
        if ( !($element instanceof CardInterface) ) {
            throw new \Exception(sprintf("Expecting CardInterface got %s", gettype($element)));
        }
        return parent::add($element);
    }

    /**
     * Removes element from collection with an additional type check.
     * @param $element
     * @return CollectionInterface
     * @throws \Exception
     */
    public function remove($element): CollectionInterface
    {
        if ( !($element instanceof CardInterface) ) {
            throw new \Exception(sprintf("Expecting CardInterface got %s", gettype($element)));
        }
        return parent::remove($element); // TODO: Change the autogenerated stub
    }

    /**
     * Sorting implementation for boarding cards.
     * @return CollectionInterface
     * @throws \Exception
     */
    public function sorted(): CollectionInterface
    {
        // Boarding cards hash table (for O(1) search)
        $hashes = [];

        // Departures and arrivals counters
        $departures = [];
        $arrivals = [];

        // Calculating hashtable for cards
        // Spending n iterations
        foreach ( $this as $card ) {
            // Useless for algorythm, but useful for IDE suggestions
            if ( !($card instanceof CardInterface) ) {
                continue;
            }
            $arrivalHashCode = $card->getArrival()->getHashCode();
            $departureHashCode = $card->getDeparture()->getHashCode();

            if ( !isset($hashes[$departureHashCode]) ) {
                $hashes[$departureHashCode] = $card;
            }
            // Count departure as +1, arrival as -1
            // Useful for next validation by checksum
            $arrivals[$arrivalHashCode] = isset($arrivals[$arrivalHashCode]) ? $arrivals[$arrivalHashCode] - 1 : -1;
            $departures[$departureHashCode] = isset($departures[$departureHashCode]) ? $departures[$departureHashCode] + 1 : 1;
        }

        // Get initial departure point(s)
        $initialDeparturePoints = array_filter(array_diff_key($departures, $arrivals), function ($value) {
            return $value > 0;
        });

        // Check initial departure points quantity (must be 1)
        $departurePointsCnt = count($initialDeparturePoints);
        if ( $departurePointsCnt !== 1 ) {
            throw new \Exception(sprintf("Expecting 1 initial departure point got %d", $departurePointsCnt), 901);
        }

        // IMPORTANT: current implementation doesn't work correctly with repeatable departures,
        // because this may lead to multiple solutions of the problem.
        // (for example: UAE -> MSK -> SPB -> MSK -> JPN)

        // Check departure points consistency
        $multipleDepartures = array_filter($departures, function ($value) {
            return $value > 1;
        });
        if ( !empty($multipleDepartures) ) {
            throw new \Exception("Multiple departures from same point isn't allowed.", 902);
        }

        // Simple structure consistency validation (we need at least 1 valid decision)
        // We need equal amount of departures and arrivals (including initial departure and last arrival)
        $checkSum = array_sum($departures) + array_sum($arrivals);
        if ( $checkSum > 0 ) {
            throw new \Exception("Structure checksum validation failed.", 903);
        }
        // TODO: invent some smart method for fast merge&sum by keys

        // Beginning to iterate with initial departure point
        $resultingCollection = new BoardingCardsCollection();


        // Processing first card (initial departure)
        $currentDeparturePointHash = key($initialDeparturePoints);
        $currentDeparturePoint = $hashes[$currentDeparturePointHash]; // Since we have only 1 element it's valid
        unset($hashes[$currentDeparturePointHash]);
        $resultingCollection->add($currentDeparturePoint); // Adding first departure to resulting collection

        // Filling result collection card by card
        // Spending another n-1 iterations (or < n-1 if we lucky enough)
        while ( !empty($hashes) && ( $currentDeparturePoint instanceof CardInterface) ) {
            // Find departure point which equal to current arrival point.
            $arrivalHash = $currentDeparturePoint->getArrival()->getHashCode();
            if ( isset($hashes[$arrivalHash]) ) {
                $currentDeparturePointHash = $arrivalHash;
                $currentDeparturePoint = $hashes[$currentDeparturePointHash];
                unset($hashes[$currentDeparturePointHash]);
                $resultingCollection->add($currentDeparturePoint);
            } else {
                $currentDeparturePoint = null; // We finished
            }
        }

        if ( !empty($hashes) ) {
            throw new \Exception("Unused boarding cards found.", 904);
        }

        return $resultingCollection;
    }

    /**
     * Default method for collection-to-string conversion.
     * @return string
     */
    public function __toString(): string
    {
        $return = "";
        $i = 1;
        foreach ($this as $card) {
            $return .= "{$i}. {$card}\n";
            ++$i;
        }
        $return .= "{$i}. You have arrived at your final destination.";
        return $return;
    }
}