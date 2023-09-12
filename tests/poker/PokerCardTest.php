<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class PokerCardTest extends TestCase
{
  public function testGetRank()
  {
    $card  = new PokerCard('CA');
    $this->assertSame(13, $card->getRank());
  }
}
