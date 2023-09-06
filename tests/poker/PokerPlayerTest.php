<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerPlayer.php');
require_once(__DIR__ . '/../../lib/poker/PokerCard.php');

class PokerPlayerTest extends TestCase
{
  public function testGetCardRanks()
  {
    $player = new PokerPlayer([new PokerCard('CA'), new PokerCard('D10')]);
    $this->assertSame([13, 9], $player->getCardRanks());
  }
}
