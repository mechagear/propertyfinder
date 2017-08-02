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

/**
 * Class BoardingCardsHelper
 * @package Mechagear\PF\Helpers
 */
class BoardingCardsHelper
{
    /**
     * Allows you to initialize the collection of boarding cards from an array.
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

            // Add additional card fields
            $remainingCardFields = array_filter($boardingCard, function ($key) {
                return !in_array($key, ['departure', 'arrival', 'transport']);
            }, ARRAY_FILTER_USE_KEY);

            // Let's assign remaining fields using some magic.
            foreach ($remainingCardFields as $key => $value) {
                $setterName = 'set' . CaseHelper::camelize($key);
                if ( method_exists($card, $setterName) ) {
                    call_user_func([$card, $setterName], $value);
                }
            }

            $result->add($card);
        }
        return $result;
    }

}