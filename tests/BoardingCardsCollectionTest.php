<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: maxru
 * Date: 31.07.17
 * Time: 22:04
 */
class BoardingCardsCollectionTest extends TestCase
{
    /**
     * @var array
     */
    protected $arraySample = [
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

    /**
     * @var null|\Mechagear\PF\Models\Collections\BoardingCardsCollection
     */
    protected $collectionSample = null;

    /**
     * Some preparations
     */
    public function setUp()
    {
        $this->collectionSample = new \Mechagear\PF\Models\Collections\BoardingCardsCollection();
        // 1st
        $card = new \Mechagear\PF\Models\Cards\CardConcrete(
            new \Mechagear\PF\Models\Points\Point("Madrid"),
            new \Mechagear\PF\Models\Points\Point("Barcelona"),
            new \Mechagear\PF\Models\Transport\TransportTrain()
        );
        $card->setSeatNumber("45B");
        $this->collectionSample->add($card);

        // 2nd
        $card = new \Mechagear\PF\Models\Cards\CardConcrete(
            new \Mechagear\PF\Models\Points\Point("Barcelona"),
            new \Mechagear\PF\Models\Points\Point("Gerona Airport"),
            new \Mechagear\PF\Models\Transport\TransportAirportBus()
        );
        $this->collectionSample->add($card);

        // 3rd
        $card = new \Mechagear\PF\Models\Cards\CardConcrete(
            new \Mechagear\PF\Models\Points\Point("Gerona Airport"),
            new \Mechagear\PF\Models\Points\Point("Stockholm"),
            new \Mechagear\PF\Models\Transport\TransportAirplane()
        );
        $card->setGate("45B");
        $card->setSeatNumber("3A");
        $card->setBaggageType(\Mechagear\PF\Models\Cards\CardBase::BAGGAGE_PLACE);
        $card->setBaggagePlace("344");
        $this->collectionSample->add($card);

        // 4th
        $card = new \Mechagear\PF\Models\Cards\CardConcrete(
            new \Mechagear\PF\Models\Points\Point("Stockholm"),
            new \Mechagear\PF\Models\Points\Point("New York JFK"),
            new \Mechagear\PF\Models\Transport\TransportAirplane()
        );
        $card->setGate("22");
        $card->setSeatNumber("7B");
        $card->setBaggageType(\Mechagear\PF\Models\Cards\CardBase::BAGGAGE_AUTO);
        $this->collectionSample->add($card);
    }

    /**
     * Test for BoardingCardsHelper::fromArray.
     */
    public function testBoardingCardsCollectionHelper()
    {
        $sample = $this->arraySample;
        $sampleCollection = clone $this->collectionSample;

        $testCollection = \Mechagear\PF\Helpers\BoardingCardsHelper::fromArray($sample);
        $this->assertEquals($testCollection, $sampleCollection, "fromArray helper doesn't work correctly.");
    }

    /**
     * Test for sorting method.
     */
    public function testSorted()
    {
        $testCollection = clone $this->collectionSample;
        // Shuffle collection
        $shuffle = [];
        foreach ( $testCollection as $card ) {
            $shuffle[] = $card;
            $testCollection->remove($card);
        }
        shuffle($shuffle);
        foreach ( $shuffle as $card ) {
            $testCollection->add($card);
        }
        // If sorting works, then the collections will match.
        $this->assertEquals($testCollection->sorted(), $this->collectionSample, "Sorting doesn't work correctly.");
    }

    /**
     * @expectedException Exception
     * @expectedExceptionCode 901
     */
    public function testWrongStructureZeroDepartures()
    {
        $testCollection = clone $this->collectionSample;

        // Adding loop (final destination to initial departure)
        $card = new \Mechagear\PF\Models\Cards\CardConcrete(
            new \Mechagear\PF\Models\Points\Point("New York JFK"),
            new \Mechagear\PF\Models\Points\Point("Madrid"),
            new \Mechagear\PF\Models\Transport\TransportAirplane()
        );

        $testCollection->add($card);
        $testCollection->sorted();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionCode 901
     */
    public function testWrongStructureMultipleDepartures()
    {
        $testCollection = clone $this->collectionSample;

        // Adding new _initial_ departure
        $card = new \Mechagear\PF\Models\Cards\CardConcrete(
            new \Mechagear\PF\Models\Points\Point("Moscow"),
            new \Mechagear\PF\Models\Points\Point("Barcelona"),
            new \Mechagear\PF\Models\Transport\TransportAirplane()
        );

        $testCollection->add($card);
        $testCollection->sorted();
    }

    /**
     * @expectedException Exception
     * @expectedExceptionCode 902
     */
    public function testWrongStructureMultipleDeparturesSamePoint()
    {
        $testCollection = clone $this->collectionSample;
        $testCollection->add($testCollection->current());
        $testCollection->sorted();
    }

    /**
     * Totally unuseful test. Checks string output of collection.
     */
    public function testStrangeUnusefulTest()
    {
        $sampleStringOutput = "1. Take train from Madrid to Barcelona. Sit in seat 45B. 
2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment. 
3. Take flight from Gerona Airport to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344. 
4. Take flight from Stockholm to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg. 
5. You have arrived at your final destination.";
        $this->assertEquals($sampleStringOutput, (string)$this->collectionSample);
    }

}