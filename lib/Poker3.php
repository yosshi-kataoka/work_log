<?php

// ◯お題

// 「ツーカードポーカー」に「カードの枚数を3枚に変更して」と仕様変更が発生しました。

// ・ツーカードポーカーのファイルをコピーして新規ファイルを作成しましょう
// ・カード枚数を3枚に変更しましょう
// ・役の仕様は下記に変更します。役は番号が大きくなるほど強くなります

// ハイカード：以下の役が一つも成立していない
// ペア：2枚のカードが同じ数字
// ストレート：3枚のカードが連続している。A は 2 と K の両方と連続しているとみなし、A を含むストレート は、A-2-3 と Q-K-A の2つ。ただし、K-A-2 のランクの組み合わせはストレートとはみなさない
// スリーカード：3枚のカードが同じ数字
// ・2つの手札について、強さは以下に従います
// 2つの手札の役が異なる場合、より上位の役を持つ手札が強いものとする
// 2つの手札の役が同じ場合、各カードの数値によって強さを比較する
// 　 ・（弱）2, 3, 4, 5, 6, 7, 8, 9, 10, J, Q, K, A (強)
// 　 ・ハイカード：一番強い数字同士を比較する。左記が同じ数字の場合、二番目に強いカード同士を比較する。左記が同じ数字の場合、三番目に強いランクを持つカード同士を比較する。左記が同じランクの場合は引き分け
// 　 ・ペア：ペアの数字を比較する。左記が同じランクの場合、ペアではない3枚目同士のランクを比較する。左記が同じランクの場合は引き分け
// 　 ・ストレート：一番強い数字を比較する (ただし、A-2-3 の組み合わせの場合、3 を一番強い数字とする。Q-K-A が最強、A-2-3 が最弱)。一番強いランクが同じ場合は引き分け
// 　 ・スリーカード：スリーカードの数字を比較する。スリーカードのランクが同じ場合は引き分け
// それぞれの役と勝敗を判定するプログラムを作成ください。

// ◯仕様

// それぞれの役と勝敗を判定するshowメソッドを定義してください。
// showメソッドは引数として、プレイヤー1のカード、プレイヤー1のカード、プレイヤー1のカード、プレイヤー2のカード、プレイヤー2のカード、プレイヤー2のカードを取ります。
// カードはH1〜H13（ハート）、S1〜S13（スペード）、D1〜D13（ダイヤ）、C1〜C13（クラブ）、となります。ただし、Jは11、Qは12、Kは13、Aは1とします。
// showメソッドは返り値として、プレイヤー1の役、プレイヤー2の役、勝利したプレイヤーの番号、を返します。引き分けの場合、プレイヤーの番号は0とします。

// ◯実行例

// show('CK', 'DJ', ,'H9', 'C10', 'H10', 'D3')  //=> ['high card', 'pair', 2]
// show('CK', 'DA', 'H2', 'C3', 'H4', 'S5')     //=> ['high card', 'straight', 2]
// show('CK', 'DJ', 'H9', 'C3', 'H3', 'S3')     //=> ['high card', 'three card', 2]
// show('C3', 'H4', 'S5', 'DK', 'SK', 'D10')    //=> ['straight', 'pair', 1]
// show('C3', 'H3', 'S3', 'DK', 'SK', 'D10')    //=> ['three card', 'pair', 1]
// show('C3', 'H3', 'S3', 'DK', 'SJ', 'DQ')     //=> ['three card', 'straight', 1]
// show('HJ', 'SK', 'D9', 'DQ', 'D10', 'H8')    //=> ['high card', 'high card', 1]
// show('H9', 'SK', 'H7', 'DK', 'D10', 'H5')    //=> ['high card', 'high card', 2]
// show('H9', 'SK', 'H7', 'DK', 'D9', 'H5')     //=> ['high card', 'high card', 1]
// show('H3', 'S5', 'C7', 'D5', 'S7', 'D3')     //=> ['high card', 'high card', 0]
// show('CA', 'DA', 'DK', 'C2', 'D2', 'C3')     //=> ['pair', 'pair', 1]
// show('CK', 'DK', 'SA', 'CA', 'DA', 'SK')     //=> ['pair', 'pair', 2]
// show('C4', 'D4', 'S7', 'H4', 'S4', 'C6')     //=> ['pair', 'pair', 1]
// show('C4', 'D4', 'S7', 'H4', 'S4', 'C7')     //=> ['pair', 'pair', 0]
// show('SA', 'DK', 'DQ', 'CA', 'C2', 'D3')     //=> ['straight', 'straight', 1]
// show('SA', 'DK', 'DQ', 'CK', 'CQ', 'DJ')     //=> ['straight', 'straight', 1]
// show('S2', 'H3', 'D4', 'CA', 'C2', 'D3')     //=> ['straight', 'straight', 1]
// show('S2', 'S3', 'S4', 'C2', 'C3', 'D4')     //=> ['straight', 'straight', 0]
// show('S2', 'C2', 'D2', 'CA', 'HA', 'SA')     //=> ['three card', 'three card', 2]
// show('SK', 'CK', 'DK', 'CA', 'HA', 'SA')     //=> ['three card', 'three card', 2]
// show('S2', 'C2', 'D2', 'C3', 'H3', 'S3')     //=> ['three card', 'three card', 2]
const NUMBER_OF_THREE_CARD = 3;
const NUMBER_OF_PAIR = 2;
const INVALID_STRAIGHT_NUMBER = 23;
const HIGH_CARD = 'high card';
const PAIR = 'pair';
const STRAIGHT = 'straight';
const THREE_CARD = 'three card';

#役の強さを定義
const HAND_RANKS = [
  HIGH_CARD => 1,
  PAIR => 2,
  STRAIGHT => 3,
  THREE_CARD => 4,
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
function show(string $card1_1, string $card1_2,  string $card1_3, string $card2_1, string $card2_2, string $card2_3): array
{
  $cardRank = [];
  $cardRank = convertToCardRanks([$card1_1, $card1_2, $card1_3, $card2_1, $card2_2, $card2_3]);
  $playerCardRanks = array_chunk($cardRank, 3);
  $hands = array_map(fn ($playerCardRank) => handJudges($playerCardRank[0], $playerCardRank[1], $playerCardRank[2]), $playerCardRanks);
  $winner = winnerCheck($hands[0], $hands[1]);
  return [
    $hands[0]['name'],
    $hands[1]['name'],
    $winner,
  ];
}
#カードの強さ、役の強さを判定
#勝者を判定

function convertToCardRanks(array $cards): array
{
  return array_map(fn ($card) => CARD_RANK[substr($card, 1, strlen($card) - 1)], $cards);
}

function handJudges(int $card1, int $card2, int $card3): array
{
  $array = [$card1, $card2, $card3];
  // if (!convertToRsort([$card1, $card2, $card3])) {
  $descendingOrderNumber = rSort($array);
  // }
  $primary = $descendingOrderNumber[0];;
  $secondary = $descendingOrderNumber[1];
  $tertiary =  $descendingOrderNumber[2];
  $name = HIGH_CARD;
  if (isThree([$card1, $card2, $card3])) {
    $name = THREE_CARD;
  } elseif (isInvalidStraight($card1, $card2, $card3)) {
  } elseif (isStraight3($card1, $card2, $card3)) {
    $name = STRAIGHT;
    if (isMinMax3($card1, $card2, $card3)) {
      $primary = min(CARD_RANK);
      $secondary = (min(CARD_RANK) + 1);
      $tertiary = max(CARD_RANK);
    }
    // 12,0,1, 10,11,12
  } elseif (isPair3([$card1, $card2, $card3])) {
    $name = PAIR;
  }
  return [
    'name' => $name,
    'rank' => HAND_RANKS[$name],
    'primary' => $primary,
    'secondary' => $secondary,
    'tertiary' => $tertiary,
  ];
}

function convertToRsort(array $cards): array
{
  $sort = rsort($cards);
  return $sort;
}
function isThree(array $cards): bool
{
  return max(array_count_values($cards)) === NUMBER_OF_THREE_CARD;
}

function isInvalidStraight(int $card1, int $card2, int $card3): bool
{
  return abs(max($card1, $card2, $card3) - min($card1, $card2, $card3)) === max(CARD_RANK) && abs($card1 + $card2 + $card3) === INVALID_STRAIGHT_NUMBER;
}

function isStraight3(int $card1, int $card2, int $card3): bool
{
  return abs(max($card1, $card2, $card3) - min($card1, $card2, $card3)) === 2 || isMinMax3($card1, $card2, $card3);
}

function isMinMax3(int $card1, int $card2, int $card3): bool
{
  return abs(max($card1, $card2, $card3) - min($card1, $card2, $card3)) === max(CARD_RANK);
}

function isPair3(array $cards): bool
{
  return max(array_count_values($cards)) === NUMBER_OF_PAIR;
}

function winnerCheck(array $hand1, array $hand2): int
{
  foreach (['rank', 'primary', 'secondary', 'tertiary'] as $k) {
    if ($hand1[$k] > $hand2[$k]) {
      return 1;
    }
    if ($hand1[$k] < $hand2[$k]) {
      return 2;
    }
  }
  return 0;
}
