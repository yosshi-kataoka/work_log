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
  private const MIN_PLAYER_NUMBER = 1;
  private const MAX_PLAYER_NUMBER = 3;


  public function start()
  {
    echo 'ブラックジャックを開始します' . PHP_EOL;
    do {
      echo '何人でプレイしますか？(1,2,3のいずれかを入力して下さい)' . PHP_EOL;
      $input = trim(fgets(STDIN));
      if (self::MIN_PLAYER_NUMBER <= $input && self::MAX_PLAYER_NUMBER >= $input) {
      } else {
        echo '0,1,2のいずれかを入力して下さい' . PHP_EOL;
      }
    } while (self::MIN_PLAYER_NUMBER > $input || self::MAX_PLAYER_NUMBER < $input);
    // numberOfPlayerを引数処理する
    $rule = $this->getRule();
    $handEvaluator = new HandEvaluator($rule);
    $players = $this->getNumberOfPlayers($input);
    $dealer = new Dealer();
    $deck = new Deck();
    $deck->createDeck();
    $playerAndDealers = array_merge($players, [$dealer]);
    foreach ($playerAndDealers as $playerAndDealer) {
      $hands = $playerAndDealer->drawCard($deck, self::USED_CARD_NUMBER);
      foreach ($hands as $hand) {
        $playerAndDealer->addHand($hand);
        $playerAndDealer->addPoint($hand);
      }
    }
    // プレイヤーを追加
    foreach ($players[0]->getHand() as $cards) {
      echo 'あなたの引いたカードは' . $players[0]->getSuit($cards) . 'の' . $players[0]->getNumber($cards) . 'です。' . PHP_EOL;
    }
    $dealerHand = $dealer->getHand()[0];
    echo 'ディーラーの引いたカードは' . $dealer->getSuit($dealerHand) . 'の' . $dealer->getNumber($dealerHand) . 'です。' . PHP_EOL;
    echo 'ディーラーの引いた2枚目のカードはわかりません' . PHP_EOL;
    $result = $handEvaluator->handJudge($players, $deck);
    return $result;
  }


  public function getRule(): StandardRule
  {
    $rule = new StandardRule();
    return $rule;
  }

  public function getNumberOfPlayers($numberOfPlayer): array
  {
    $players = [];
    $players[] = new Player('あなた');
    switch ($numberOfPlayer) {
      case 2:
        $players[] = new Player('CPU1');
        break;
      case 3;
        $players[] = new Player('CPU1');
        $players[] = new Player('CPU2');
        break;
    }
    return $players;
  }
}
