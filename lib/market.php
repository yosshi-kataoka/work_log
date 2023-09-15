<?php
// ◯お題
// スーパーで買い物したときの支払金額を計算するプログラムを書きましょう。
// 以下の商品リストがあります。先頭の数字は商品番号です。金額は税抜です。

// 玉ねぎ 100円
// 人参 150円
// りんご 200円
// ぶどう 350円
// 牛乳 180円
// 卵 220円
// 唐揚げ弁当 440円
// のり弁 380円
// お茶 80円
// コーヒー 100円
// また、以下の条件を満たすと割引されます。

// a. 玉ねぎは3つ買うと50円引き
// b. 玉ねぎは5つ買うと100円引き
// c. 弁当と飲み物を一緒に買うと20円引き（ただし適用は一組ずつ）
// d. お弁当は20〜23時はタイムセールで半額

// 合計金額（税込み）を求めてください。

// ◯仕様
// 金額を計算するcalc関数を定義してください。
// calcメソッドは「購入時刻 商品番号 商品番号 商品番号 ...」を引数に取り、合計金額（税込み）を返します。
// 購入時刻はHH:MM形式（例. 20:00）とし、商品番号は1〜10の整数とします。
// 同時に買える商品は20個までです。また、購入時刻は9〜23時です。

// ◯実行例

// calcRation('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10])  //=> 1298

const ITEM_PRICE_LIST = [
  1 => ['price' => 100, 'type' => ''],
  2 => ['price' => 150, 'type' => ''],
  3 => ['price' => 200, 'type' => ''],
  4 => ['price' => 350, 'type' => ''],
  5 => ['price' => 180, 'type' => 'drink'],
  6 => ['price' => 220, 'type' => ''],
  7 => ['price' => 440, 'type' => 'bento'],
  8 => ['price' => 380, 'type' => 'bento'],
  9 => ['price' => 80, 'type' => 'drink'],
  10 => ['price' => 100, 'type' => 'drink'],
];
const TAX_RATE = 10;
const SECONDARY_DISCOUNT_ONION_NUMBER = 5;
const SECONDARY_DISCOUNT_ONION_PRICE = 100;
const PRIMARY_DISCOUNT_ONION_NUMBER = 3;
const PRIMARY_DISCOUNT_ONION_PRICE = 50;
const DISCOUNT_SET_PRICE = 20;
const DISCOUNT_TIME = '20:00';

function calcRation(string $time, array $items): int
{
  $totalPrice = 0;
  $drink = 0;
  $bento = 0;
  $bentoPrice = 0;
  foreach ($items as $item) {
    if (ITEM_PRICE_LIST[$item]['type'] === 'drink') {
      $drink++;
    } elseif (ITEM_PRICE_LIST[$item]['type'] === 'bento') {
      $bento++;
      $bentoPrice += ITEM_PRICE_LIST[$item]['price'];
    }
    $totalPrice += ITEM_PRICE_LIST[$item]['price'];
  }
  $totalPrice -= discountOnionPrice(array_count_values($items)[1]);
  $totalPrice -= discountSetPrice($drink, $bento);
  $totalPrice -= discountTimeSale($time, $bentoPrice);
  return (int)$totalPrice * (100 + TAX_RATE) / 100;
}

function discountOnionPrice(int $onion_number): int
{
  if ($onion_number >= SECOND_ONION_DISCOUNT_NUMBER) {
    return SECOND_ONION_DISCOUNT_PRICE;
  } elseif ($onion_number >= PRIMARY_DISCOUNT_ONION_NUMBER) {
    return PRIMARY_DISCOUNT_ONION_PRICE;
  }
  return 0;
}

function discountSetPrice(int $drinkNumber, int $bentoNumber): int
{
  return DISCOUNT_SET_PRICE * min($drinkNumber, $bentoNumber);
}

function discountTimeSale(string $time, int $bentoPrice): int
{
  if (strtotime(DISCOUNT_TIME) < strtotime($time)) {
    return $bentoPrice / 2;
  }
  return 0;
}
