<?php
require __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';
/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 22:14
 */

$data = [
    [
        'departure' => 'NYZ',
        'arrival' => 'MSK',
        'transport' => 'airport_bus',
    ],
    [
        'departure' => 'SPB',
        'arrival' => 'JPN',
        'transport' => 'airplane',
        'seat_number' => '54B',
        'gate'      => '22',
        'baggage_type' => \Mechagear\PF\Models\Cards\CardBase::BAGGAGE_PLACE,
        'baggage_place' => '512',
    ],
    [
        'departure' => 'MSK',
        'arrival' => 'SPB',
        'transport' => 'train',
        'seat_number' => '12',
        'baggage_type' => \Mechagear\PF\Models\Cards\CardBase::BAGGAGE_AUTO,
    ],
];

$collection = \Mechagear\PF\Helpers\BoardingCardsHelper::fromArray($data);
echo $collection->sorted();