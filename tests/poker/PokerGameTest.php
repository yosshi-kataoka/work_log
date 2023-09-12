<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerGame.php');

class PokerGameTest extends TestCase
{
  public function testStart()
  {
    $game = new PokerGame(['CA', 'DA'], ['C9', 'H10']);
    $this->assertSame(['pair', 'straight'], $game->start());
  }
}
