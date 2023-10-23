<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;
use BlackJack\Deck;
use ReflectionClass;

require_once(__DIR__ . '/../../lib/BlackJack/Player.php');


class PlayerTest extends TestCase
{
  public function testDrawCard()
  {
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $this->assertSame(2, count($player->drawCard($deck, 2)));
  }

  public function testAddHand()
  {
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hand = $player->drawCard($deck, 2);
    $player->addHand($hand[0]);
    $result = $player->getHand();
    $this->assertObjectHasProperty('suit', $result[0]);
    $this->assertObjectHasProperty('number', $result[0]);
    $this->assertObjectHasProperty('score', $result[0]);
  }

  public function testAddPoint()
  {
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hands = $player->drawCard($deck, 1);
    $player->addPoint($hands[0]);
    $this->assertGreaterThanOrEqual(1, $player->getPoint());
    $this->assertLessThanOrEqual(11, $player->getPoint());
  }

  public function testGetHand()
  {
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hand = $player->drawCard($deck, 1);
    $player->addHand($hand[0]);
    $result = $player->getHand();
    $this->assertSame(1, count($result));
  }

  public function testGetSuit()
  {
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hand = $player->drawCard($deck, 1);
    $player->addHand($hand[0]);
    $searchSuits = ['ハート', 'スペード', 'ダイア', 'クラブ'];
    $suit = $player->getSuit($hand[0]);
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
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hand = $player->drawCard($deck, 1);
    $player->addHand($hand[0]);
    $searchStrings = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    $playerHand = $player->getNumber($hand[0]);
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
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hand = $player->drawCard($deck, 1);
    $player->addHand($hand[0]);
    $reflection = new ReflectionClass($player);
    $method = $reflection->getMethod('getScore');
    $result = $method->invoke($player, $hand[0]);
    $this->assertGreaterThanOrEqual(1, $result);
    $this->assertLessThanOrEqual(11, $result);
  }

  public function getPoint()
  {
    $player = new Player('あなた');
    $deck = new Deck();
    $deck->createDeck();
    $hand = $player->drawCard($deck, 2);
    $player->addPoint($hand[0]);
    $result = $player->getPoint();
    $this->assertSame(2, $result);
  }
}
