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
        'departure' => 'MSK',
        'arrival' => 'NYZ',
        'transport' => [
            'type' => 'airport_bus',
            'seatCode' => '56B',
        ]
    ]
];

$collection = \Mechagear\PF\Helpers\BoardingCardsHelper::fromArray($data);


var_dump($collection);

foreach ( $collection as $card ) {
    echo $card . "\n";
}