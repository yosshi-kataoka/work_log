<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class PokerCardTest extends TestCase
{
  public function testGetRank()
  {
    $pokerCards  = new PokerCard('CA');
    $this->assertSame(13, $pokerCards->getRank());
  }
}
