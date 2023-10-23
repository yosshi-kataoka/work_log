<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Dealer;
use BlackJack\Deck;
use ReflectionClass;

require_once(__DIR__ . '/../../lib/BlackJack/Dealer.php');


class DealerTest extends TestCase
{
  public function testDrawCard()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $this->assertSame(2, count($dealer->drawCard($deck, 2)));
  }

  public function testAddHand()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hand = $dealer->drawCard($deck, 2);
    $dealer->addHand($hand[0]);
    $result = $dealer->getHand();
    $this->assertObjectHasProperty('suit', $result[0]);
    $this->assertObjectHasProperty('number', $result[0]);
    $this->assertObjectHasProperty('score', $result[0]);
  }

  public function testAddPoint()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hand = $dealer->drawCard($deck, 1);
    $dealer->addPoint($hand[0]);
    $this->assertGreaterThanOrEqual(1, $dealer->getPoint());
    $this->assertLessThanOrEqual(11, $dealer->getPoint());
  }

  public function testGetHand()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hand = $dealer->drawCard($deck, 1);
    $dealer->addHand($hand[0]);
    $result = $dealer->getHand();
    $this->assertSame(1, count($result));
  }

  public function testGetSuit()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hand = $dealer->drawCard($deck, 1);
    $dealer->addHand($hand[0]);
    $searchSuits = ['ハート', 'スペード', 'ダイア', 'クラブ'];
    $suit = $dealer->getSuit($hand[0]);
    $result = false;
    foreach ($searchSuits as $searchSuit) {
      if (str_contains($searchSuit, $suit)) {
        $result = true;
      }
    }
    $this->assertSame(true, $result);
  }

  public function testGetNumber()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hand = $dealer->drawCard($deck, 1);
    $dealer->addHand($hand[0]);
    $searchStrings = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    $playerHand = $dealer->getNumber($hand[0]);
    $result = false;
    foreach ($searchStrings as $searchString) {
      if (str_contains($searchString, $playerHand)) {
        $result = true;
      }
    }
    $this->assertSame(true, $result);
  }

  public function testGetScore()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hands = $dealer->drawCard($deck, 1);
    $dealer->addPoint($hands[0]);
    $this->assertGreaterThanOrEqual(1, $dealer->getPoint());
    $this->assertLessThanOrEqual(11, $dealer->getPoint());
  }

  public function getPoint()
  {
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $hand = $dealer->drawCard($deck, 2);
    $dealer->addPoint($hand[0]);
    $result = $dealer->getPoint();
    $this->assertSame(2, $result);
  }
}
