<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:10
 */

namespace Mechagear\PF\Helpers;


use Mechagear\PF\Models\Cards\CardConcrete;
use Mechagear\PF\Models\Point;
use Mechagear\PF\Models\Transport\TransportBase;

class BoardingCardsHelper
{
    /**
     * @param array $boardingCardsList
     * @return array|\SplFixedArray
     * @throws \Exception
     */
    public static function fromArray(array $boardingCardsList = [])
    {
        $collectionSize = count($boardingCardsList);
        $result = new \SplFixedArray($collectionSize); // A little bit faster than regular array

        $i = 0;
        foreach ( $boardingCardsList as $boardingCard ) {
            if ( empty($boardingCard['departure']) || empty($boardingCard['arrival']) || empty($boardingCard['transport']) ) {
                // TODO: use concrete Exception type (InvalidParameters or something else)
                throw new \Exception("Not enough data for boarding card initialization.");
            }

            $card = new CardConcrete(new Point($boardingCard['departure']), new Point($boardingCard['arrival']), TransportBase::factory($boardingCard['transport']));
            $result[$i] = $card;
            ++$i;
        }
        return $result;
    }

}