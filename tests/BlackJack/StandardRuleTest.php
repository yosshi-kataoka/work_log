<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;
use BlackJack\Dealer;
use BlackJack\Deck;
use BlackJack\StandardRule;

require_once(__DIR__ . '/../../lib/BlackJack/Player.php');


class StandardRuleTest extends TestCase
{
  public function testHandJudge()
  {
    $player = new Player('あなた');
    $dealer = new Dealer();
    $standardRule = new StandardRule();
    $players = [$player, $dealer];
    $deck = new Deck();
    $deck->createDeck();
    foreach ($players as $player) {
      $hands = $player->drawCard($deck, 2);
      foreach ($hands as $card) {
        $player->addHand($card);
        $player->addPoint($card);
      }
    }
    $result = $standardRule->handJudge($players, $deck);
    $this->assertSame(true, $result);
  }
}
