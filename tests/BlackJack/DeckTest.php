<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Deck;

require_once(__DIR__ . '/../../lib/BlackJack/Deck.php');


class DeckTest extends TestCase
{

  public function testDrawCard()
  {
    $deck = new Deck();
    $deck->createDeck();
    $result = $deck->DrawCard(2);
    $this->assertSame(2, count($result));
    $this->assertSame(50, count($deck->getCard()));
  }

  public function testCreateDeck()
  {
    $deck = new Deck();
    $result = $deck->createDeck();
    $this->assertSame(52, count($result));
  }

  public function testGetCard()
  {
    $deck = new Deck();
    $deck->createDeck();
    $result = $deck->getCard();
    $this->assertSame(52, count($result));
  }
}
