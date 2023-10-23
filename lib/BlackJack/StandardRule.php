<?php

namespace BlackJack;

require_once('Rule.php');

class StandardRule implements Rule
{
  private const MAX_POINT = 21;
  private const ADD_CARD_NUMBER = 1;
  private const DEALER_MINIMUM_POINT = 17;

  public function handJudge(array $players, Deck $deck): bool
  {
    while ($players[0]->getPoint() < self::MAX_POINT) {
      echo 'あなたの現在の得点は' . $players[0]->getPoint() . 'です。カードを引きますか？（Y/N）' . PHP_EOL;
      $input = trim(fgets(STDIN));
      if ($input === "Y") {
        $playerAddHand = $players[0]->drawCard($deck, self::ADD_CARD_NUMBER);
        $players[0]->addPoint($playerAddHand[0]);
        $players[0]->addHand($playerAddHand[0]);
        echo 'あなたの引いたカードは' . $players[0]->getSuit($playerAddHand[0]) . 'の' . $players[0]->getNumber($playerAddHand[0]) . 'です。' . PHP_EOL;
        if ($players[0]->getPoint() > self::MAX_POINT) {
          echo 'あなたの得点が21を超えました。' . PHP_EOL;
          echo 'ディーラーの勝ちです。' . PHP_EOL;
          echo 'ブラックジャックを終了します。' . PHP_EOL;
          exit;
        }
      } elseif ($input === "N") {
        break;
      } else {
        echo 'YもしくはNにて回答して下さい。' . PHP_EOL;
      }
    }

    while ($players[1]->getPoint() < self::DEALER_MINIMUM_POINT) {
      $dealerAddHand = $players[1]->drawCard($deck, self::ADD_CARD_NUMBER);
      $players[1]->addPoint($dealerAddHand[0]);
      $players[1]->addHand($dealerAddHand[0]);
    }
    echo 'あなたの得点は' . $players[0]->getPoint() . 'です' . PHP_EOL;
    echo 'ディーラーの得点は' . $players[1]->getPoint() . 'です。' . PHP_EOL;
    if ($players[0]->getPoint() === $players[1]->getPoint()) {
      echo '引き分けです。' . PHP_EOL;
    }
    if ($players[0]->getPoint() > $players[1]->getPoint() || $players[1]->getPoint() > self::MAX_POINT) {
      echo 'あなたの勝ちです！' . PHP_EOL;
    } elseif ($players[0]->getPoint() < $players[1]->getPoint()) {
      echo 'あなたの負けです！' . PHP_EOL;
    }
    echo 'ブラックジャックを終了します。' . PHP_EOL;
    return true;
  }
}
