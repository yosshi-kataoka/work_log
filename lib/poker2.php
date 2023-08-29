<?php
// ◯お題

// 2枚の手札でポーカーを行います。ルールは次の通りです。

// ・プレイヤーは2人です
// ・各プレイヤーはトランプ2枚を与えられます
// ・ジョーカーはありません
// ・与えられたカードから、役を判定します。役は番号が大きくなるほど強くなります

// ハイカード：以下の役が一つも成立していない
// ペア：2枚のカードが同じ数字
// ストレート：2枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2 と K-A の2つです
// ・2つの手札について、強さは以下に従います
// 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
// 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
// 　 ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
// 　 ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、もう一枚のカード同士を比較する
// 　 ・ペア：ペアの数字を比較する
// 　 ・ストレート：一番強い数字を比較する (ただし、A-2 の組み合わせの場合、2 を一番強い数字とする。K-A が最強、A-2 が最弱)
// 　 ・数値が同じ場合：引き分け
// 　
// それぞれの役と勝敗を判定するプログラムを作成ください。
// ◯仕様

// それぞれの役と勝敗を判定するshowDownメソッドを定義してください。
// showDownメソッドは引数として、プレイヤー1のカード、プレイヤー1のカード、プレイヤー2のカード、プレイヤー2のカードを取ります。
// カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします。
// showDownメソッドは返り値として、プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号、を返します。引き分けの場合、プレイヤーの番号は0とします。

// ◯実行例

// showDown('CK', 'DJ', 'C10', 'H10')  //=> ['high card', 'pair', 2]
// showDown('CK', 'DJ', 'C3', 'H4')    //=> ['high card', 'straight', 2]
// showDown('C3', 'H4', 'DK', 'SK')    //=> ['straight', 'pair', 1]
// showDown('HJ', 'SK', 'DQ', 'D10')   //=> ['high card', 'high card', 1]
// showDown('H9', 'SK', 'DK', 'D10')   //=> ['high card', 'high card', 2]
// showDown('H3', 'S5', 'D5', 'D3')    //=> ['high card', 'high card', 0]
// showDown('CA', 'DA', 'C2', 'D2')    //=> ['pair', 'pair', 1]
// showDown('CK', 'DK', 'CA', 'DA')    //=> ['pair', 'pair', 2]
// showDown('C4', 'D4', 'H4', 'S4')    //=> ['pair', 'pair', 0]
// showDown('SA', 'DK', 'C2', 'CA')    //=> ['straight', 'straight', 1]
// showDown('C2', 'CA', 'S2', 'D3')    //=> ['straight', 'straight', 2]
// showDown('S2', 'D3', 'C2', 'H3')    //=> ['straight', 'straight', 0] -->

const HIGH_CARD = 'high card';
const PAIR = 'pair';
const STRAIGHT = 'straight';

#役の強さを定義
const HAND_RANKS = [
  HIGH_CARD => 1,
  PAIR => 2,
  STRAIGHT => 3,
];

#カードの強さを定義
const CARDS = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

define('CARD_RANK', (function () {
  $cardRanks = [];
  foreach (CARDS as $index => $number) {
    $cardRanks[$number] = $index;
  }
  return $cardRanks;
})());

#カードの文字列をカードの強さの値に変換
function showDown2(string $card1_1, string $card1_2, string $card2_1, string $card2_2): array
{
  $cardRank = [];
  $cardRank = convertToCardRank([$card1_1, $card1_2, $card2_1, $card2_2]);
  $playerCardRanks = array_chunk($cardRank, 2);
  $hands = array_map(fn ($playerCardRank) => handJudge($playerCardRank[0], $playerCardRank[1]), $playerCardRanks);
  $winner = winnerJudge($hands[0], $hands[1]);
  return [
    $hands[0]['name'],
    $hands[1]['name'],
    $winner,
  ];
}
#カードの強さ、役の強さを判定
#勝者を判定

function convertToCardRank(array $cards): array
{
  return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

function handJudge(int $card1, int $card2): array
{
  $primary = max($card1, $card2);
  $secondary = min($card1, $card2);
  $name = HIGH_CARD;
  if (isStraight2($card1, $card2)) {
    $name = STRAIGHT;
    if (isMinMax2($card1, $card2)) {
      $primary = min(CARD_RANK);
      $secondary = max(CARD_RANK);
    }
  } elseif (isPair2($card1, $card2)) {
    $name = PAIR;
  }
  return [
    'name' => $name,
    'rank' => HAND_RANKS[$name],
    'primary' => $primary,
    'secondary' => $secondary,
  ];
}

function isStraight2(int $card1, int $card2): bool
{
  return abs($card1 -  $card2) === 1 || isMinMax2($card1, $card2);
}

function isMinMax2(int $card1, int $card2): bool
{
  return abs($card1 - $card2) === max(CARD_RANK);
}

function isPair2(int $card1, int $card2): bool
{
  return $card1 === $card2;
}

function winnerJudge(array $hand1, array $hand2): int
{
  foreach (['rank', 'primary', 'secondary'] as $k) {
    if ($hand1[$k] > $hand2[$k]) {
      return 1;
    }
    if ($hand1[$k] < $hand2[$k]) {
      return 2;
    }
  }
  return 0;
}
