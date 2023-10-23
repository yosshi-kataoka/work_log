<?php

namespace BlackJack\Tests;

use PHPUnit\Framework\TestCase;
use BlackJack\Player;
use BlackJack\Dealer;
use BlackJack\StandardRule;
use BlackJack\HandEvaluator;
use BlackJack\Deck;

require_once(__DIR__ . '/../../lib/BlackJack/Player.php');
require_once(__DIR__ . '/../../lib/BlackJack/Dealer.php');
require_once(__DIR__ . '/../../lib/BlackJack/StandardRule.php');
require_once(__DIR__ . '/../../lib/BlackJack/HandEvaluator.php');
require_once(__DIR__ . '/../../lib/BlackJack/Deck.php');

class HandEvaluatorTest extends TestCase
{
  public function testHandJudge()
  {
    $player = new Player('あなた');
    $dealer = new Dealer();
    $standardRule = new StandardRule();
    $handEvaluator = new HandEvaluator($standardRule);
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
    $result = $handEvaluator->handJudge($players, $deck);
    $this->assertSame(true, $result);
  }
}
