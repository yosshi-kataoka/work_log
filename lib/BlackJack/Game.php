<?php

namespace BlackJack;

require_once('StandardRule.php');
require_once('HandEvaluator.php');
require_once('Player.php');
require_once('Dealer.php');
require_once('Deck.php');

use BlackJack\StandardRule;
use BlackJack\HandEvaluator;
use BlackJack\Player;
use BlackJack\Dealer;
use BlackJack\Deck;


class Game
{
  public function __construct(private string $ruleType)
  {
  }

  private const USED_CARD_NUMBER = 2;

  public function start()
  {
    echo 'ブラックジャックを開始します' . PHP_EOL;
    $rule = $this->getRule();
    $handEvaluator = new HandEvaluator($rule);
    $players = $this->getNumberOfPlayers();
    $deck = new Deck();
    $deck->createDeck();
    foreach ($players as $player) {
      $hands = $player->drawCard($deck, self::USED_CARD_NUMBER);
      foreach ($hands as $card) {
        $player->addHand($card);
        $player->addPoint($card);
      }
    }

    foreach ($players[0]->getHand() as $cards) {
      echo 'あなたの引いたカードは' . $players[0]->getSuit($cards) . 'の' . $players[0]->getNumber($cards) . 'です。' . PHP_EOL;
    }
    $dealerHand = $players[1]->getHand()[0];
    echo 'ディーラーの引いたカードは' . $players[1]->getSuit($dealerHand) . 'の' . $players[1]->getNumber($dealerHand) . 'です。' . PHP_EOL;
    echo 'ディーラーの引いた2枚目のカードはわかりません' . PHP_EOL;
    $result = $handEvaluator->handJudge($players, $deck);
    return $result;
  }


  public function getRule(): StandardRule
  {
    $rule = new StandardRule();
    return $rule;
  }

  public function getNumberOfPlayers(): array
  {
    $player = new Player();
    $dealer = new Dealer();
    return [$player, $dealer];
  }
}
