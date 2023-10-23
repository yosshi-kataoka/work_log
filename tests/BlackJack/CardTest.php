<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Card;

require_once(__DIR__ . '/../../lib/BlackJack/Card.php');


class CardTest extends TestCase
{
  public function testGetSuit()
  {
    $card = new Card('ハート', 5, 5);
    $this->assertSame('ハート', $card->getSuit());
  }

  public function testGetNumber()
  {
    $card = new Card('ハート', '5', 5);
    $this->assertSame('5', $card->getNumber());
  }

  public function testGetScore()
  {
    $card = new Card('ハート', 'A', 11);
    $this->assertSame(11, $card->getScore());
  }
}
