<?php
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 23:10
 */

namespace Mechagear\PF\Helpers;


use Mechagear\PF\Models\Cards\CardConcrete;
use Mechagear\PF\Models\Collections\BoardingCardsCollection;
use Mechagear\PF\Models\Collections\CollectionInterface;
use Mechagear\PF\Models\Points\Point;
use Mechagear\PF\Models\Transport\TransportBase;

class BoardingCardsHelper
{
    /**
     * @param array $boardingCardsList
     * @return CollectionInterface
     * @throws \Exception
     */
    public static function fromArray(array $boardingCardsList = []): CollectionInterface
    {
        $result = new BoardingCardsCollection();

        foreach ( $boardingCardsList as $boardingCard ) {
            if ( empty($boardingCard['departure']) || empty($boardingCard['arrival']) || empty($boardingCard['transport']) ) {
                // TODO: use concrete Exception type (InvalidParameters or something else)
                throw new \Exception("Not enough data for boarding card initialization.");
            }

            $card = new CardConcrete(new Point($boardingCard['departure']), new Point($boardingCard['arrival']), TransportBase::factory($boardingCard['transport']));
            $result->add($card);
        }
        return $result;
    }

}