<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Game;
use BlackJack\StandardRule;
use BlackJack\Player;
use BlackJack\Dealer;

require_once(__DIR__ . '/../../lib/BlackJack/Game.php');
require_once(__DIR__ . '/../../lib/BlackJack/StandardRule.php');
require_once(__DIR__ . '/../../lib/BlackJack/Player.php');
require_once(__DIR__ . '/../../lib/BlackJack/Dealer.php');

class GameTest extends TestCase
{
  public function testStart()
  {
    $game = new Game('standardRule');
    $result = $game->start();
    $this->assertSame(true, $result);
  }

  public function testGetRule()
  {
    $game = new game('standardRule');
    $result = $game->getRule();
    $this->assertInstanceOf(StandardRule::class, $result);
  }

  public function getNumberOfPlayers()
  {
    $game = new game('standardRule');
    $result = $game->getNumberOfPlayers();
    $this->assertInstanceOf(Player::class, $result);
    $this->assertInstanceOf(Dealer::class, $result);
  }
}
