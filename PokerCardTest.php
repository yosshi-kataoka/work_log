<?php

namespace Poker\Tests;

use PHPUnit\Framework\TestCase;
use Poker\PokerCard;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class PokerCardTest extends TestCase
{
  public function testGetRank()
  {
    $card  = new PokerCard('CA');
    $this->assertSame(13, $card->getRank());
  }
}
