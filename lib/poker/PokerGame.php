<?php

// ◯お題1

// 「ツーカードポーカー」に以下の仕様変更が発生しました。

// カードが2枚の場合、勝敗を判定する処理を追加してください
// カードが3枚の場合、勝敗を判定する処理を追加してください
// 勝敗の判定は以下のルールに則ってください。

// カード2枚の場合は、以下のルールに従い役の判定を行います
// ハイカード：以下の役が一つも成立していない
// ペア：2枚のカードが同じ数字
// ストレート：2枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレートは、A-2 と K-A の2つです
// カード2枚の場合の手札について、強さは以下に従います
// 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
// 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
// 　 * （弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
// 　 * ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、もう一枚のカード同士を比較する
// 　 * ペア：ペアの数字を比較する
// 　 * ストレート：一番強い数字を比較する (ただし、A-2 の組み合わせの場合、2 を一番強い数字とする。K-A が最強、A-2 が最弱)
// 　 * 数値が同じ場合：引き分け
// カード3枚の場合は、以下のルールに従い役の判定を行います
// ハイカード：以下の役が一つも成立していない
// ペア：2枚のカードが同じ数字
// ストレート：3枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレートは、A-2-3 と Q-K-A の2つです。ただし、K-A-2 のランクの組み合わせはストレートとはみなさない
// スリーカード：3枚のカードが同じ数字
// カード3枚の場合の手札について、強さは以下に従います
// 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
// 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
// 　 ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
// 　 ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、二番目に強いカード同士を比較する。左記が同じ数字の場合、三番目に強いランクを持つカード同士を比較する。左記が同じランクの場合は引き分け
// 　 ・ペア：ペアの数字を比較する。左記が同じランクの場合、ペアではない3枚目同士のランクを比較する。左記が同じランクの場合は引き分け
// 　 ・ストレート：一番強い数字を比較する (ただし、A-2-3 の組み合わせの場合、3 を一番強い数字とする。Q-K-A が最強、A-2-3 が最弱)。一番強いランクが同じ場合は引き分け
// 　 ・スリーカード：スリーカードの数字を比較する。スリーカードのランクが同じ場合は引き分け
// それぞれの役と勝敗を判定するプログラムを作成ください。

// ◯仕様1

// プログラムを実行すると「プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号」を返します。引き分けの場合、プレイヤーの番号は0とします
namespace Poker;

use Poker\PokerCard;
use Poker\PokerHandEvaluator;
use Poker\CardRuleA;
use Poker\CardRuleB;


require_once(__DIR__ . '/PokerCard.php');
require_once(__DIR__ . '/PokerHandEvaluator.php');
require_once('CardRuleA.php');
require_once('CardRuleB.php');

class PokerGame
{
  private const THREE_CARDS_USED = 3;

  public function __construct(private array $cards1, private array $cards2)
  {
  }

  public function start(): array
  {
    $hands = [];
    $cardRule = $this->getCardRule();
    foreach ([$this->cards1, $this->cards2] as $cards) {
      $pokerCards = array_map(fn ($card) => new PokerCard($card), $cards);
      $handEvaluator = new PokerHandEvaluator($cardRule);
      $hands[] = $handEvaluator->getHand($pokerCards);
    }
    $winner = $handEvaluator->getWinner($hands[0], $hands[1]);
    return [$hands[0][0], $hands[1][0], $winner];
  }

  public function getCardRule()
  {
    $rule = new CardRuleA();
    if (count($this->cards1) === self::THREE_CARDS_USED) {
      return $rule = new CardRuleB();
    }
    return $rule;
  }
}
