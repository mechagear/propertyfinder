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
        'transport' => 'airport_bus'
    ],
    [
        'departure' => 'SPB',
        'arrival' => 'JPN',
        'transport' => 'airplane'
    ],
    [
        'departure' => 'MSK',
        'arrival' => 'SPB',
        'transport' => 'train'
    ],
];

$collection = \Mechagear\PF\Helpers\BoardingCardsHelper::fromArray($data);


var_dump($collection->sorted());

foreach ( $collection as $card ) {
    echo $card . "\n";
}