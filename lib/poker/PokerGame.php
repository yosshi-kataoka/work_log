<?php
// お題
// ツーカードポーカーで以下の仕様変更がありました。

// 与えられたカードから、役を判定します。
// ハイカード：以下の役が一つも成立していない
// ペア：2枚のカードが同じ数字
// ストレート：2枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2 と K-A の2つです
// 単一責任の原則を意識して実装しましょう。

// ◯仕様

// プログラムを実行すると「プレイヤー1の役、プレイヤー2の役」を返します

require_once(__DIR__ . '/PokerCard.php');
require_once(__DIR__ . '/PokerHandEvaluator.php');
require_once('CardRuleA.php');
require_once('CardRuleB.php');
require_once('CardRuleC.php');

class PokerGame
{
  private const TWO_CARDS_USED = 2;
  private const THREE_CARDS_USED = 3;
  private const FIVE_CARDS_USED = 5;

  public function __construct(private array $cards1, private array $cards2)
  {
  }

  public function start(): array
  {
    $hands = [];
    $CardRule = $this->getCardRule();
    foreach ([$this->cards1, $this->cards2] as $cards) {
      $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
      $handEvaluator = new PokerHandEvaluator($CardRule);
      $hands[] = $handEvaluator->getHand($pokerCards);
    }
    return $hands;
  }

  public function getCardRule()
  {
    if (count($this->cards1) === self::TWO_CARDS_USED) {
      return new CardRuleA();
    }
    if (count($this->cards1) === self::THREE_CARDS_USED) {
      return new CardRuleB();
    }
    if (count($this->cards1) === self::FIVE_CARDS_USED) {
      return new CardRuleC();
    }
  }
}
