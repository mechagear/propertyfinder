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
        "departure"     => "Madrid",
        "arrival"       => "Barcelona",
        "transport"     => "train",
        "seat_number"   => "45B",
    ],
    [
        "departure"     => "Barcelona",
        "arrival"       => "Gerona Airport",
        "transport"     => "airport_bus",
    ],
    [
        "departure"     => "Gerona Airport",
        "arrival"       => "Stockholm",
        "transport"     => "airplane",
        "gate"          => "45B",
        "seat_number"   => "3A",
        "baggage_type"  => \Mechagear\PF\Models\Cards\CardBase::BAGGAGE_PLACE,
        "baggage_place" => "344",
    ],
    [
        "departure"     => "Stockholm",
        "arrival"       => "New York JFK",
        "transport"     => "airplane",
        "gate"          => "22",
        "seat_number"   => "7B",
        "baggage_type"  => \Mechagear\PF\Models\Cards\CardBase::BAGGAGE_AUTO,
    ]
];

$collection = \Mechagear\PF\Helpers\BoardingCardsHelper::fromArray($data);
echo $collection->sorted();
exit(0);