<?php
// ◯お題
// あなたは小さなパン屋を営んでいました。一日の終りに売上の集計作業を行います。
// 商品は10種類あり、それぞれ金額は以下の通りです（税抜）。
// ①100
// ②120
// ③150
// ④250
// ⑤80
// ⑥120
// ⑦100
// ⑧180
// ⑨50
// ⑩300
// 一日の売上の合計（税込み）と、販売個数の最も多い商品番号と販売個数の最も少ない商品番号を求めてください。

// ◯インプット
// 入力は以下の形式で与えられます。
// 販売した商品番号 販売個数 販売した商品番号 販売個数 ...
// ※ただし、販売した商品番号は1〜10の整数とする。
// ◯アウトプット
// 売上の合計
// 販売個数の最も多い商品番号
// 販売個数の最も少ない商品番号
// ※ただし、税率は10%とする。
// ※また、販売個数の最も多い商品と販売個数の最も少ない商品について、販売個数が同数の商品が存在する場合、それら全ての商品番号を記載すること。

// ◯インプット例
// 1 10 2 3 5 1 7 5 10 1
// ◯アウトプット例
// 2464
// 1
// 5 10

// ◯実行コマンド例
// php quiz.php 1 10 2 3 5 1 7 5 10 1 -->

// データ構造
// {[1]=>10,[2]=>3,[5]=>1...[10]=>1}
// 入力
// ターミナル上にてデータを入力して入力値を連想配列として定義
// 入力データをデータ構造の形に変換
// 売上の合計
// パンの価格を{[1]=>100,[2]=>120...[10]=>300}の連想配列と定義し、販売数量と乗算して合計金額を算出する
// 最小・最大販売数量
// データ構造を元に、max・min関数を用いて[]keyのデータを得る

const BREADS = [
  1 => 100,
  2 => 120,
  3 => 150,
  4 => 250,
  5 => 80,
  6 => 120,
  7 => 100,
  8 => 180,
  9 => 50,
  10 => 300,
];
const SPLIT_LENGTH = 2;
const TAX = 10;

// 入力値を求めるデータ構造に変換する
function getInput(): array
{
  $argument = array_slice($_SERVER['argv'], 1);
  $args = array_chunk($argument, SPLIT_LENGTH);
  // var_dump($args);
  $inputs = [];
  foreach ($args as $arg) {
    $inputs[$arg[0]] = (int)$arg[1];
  }
  return $inputs;
}

// 商品の販売合計金額を得る
function getTotalPrice(array $inputs)
{
  $sum = 0;
  foreach ($inputs as $number => $volume) {
    $sum += BREADS[$number] * (int)$volume;
  }
  return $sum * (100 + TAX) / 100;
}

// 販売数量が最も多い商品番号を得る
function getMaxSalesItemNumber(array $inputs): array
{
  $max = max(array_values($inputs));
  return array_keys($inputs, $max);
}

// 販売数量が最も少ない商品番号を得る
function getMinSalesItemNumber(array $inputs): array
{
  $min = min(array_values($inputs));
  return array_keys($inputs, $min);
}

// 得たデータを表示する
function display(...$results): void
{
  foreach ($results as $result) {
    echo implode(' ', $result) . PHP_EOL;
  }
}

$inputs = getInput();
$totalPrice = getTotalPrice($inputs);
$maxSalesItemNumber = getMaxSalesItemNumber($inputs);
$minSalesItemNumber = getMinSalesItemNumber($inputs);
display([$totalPrice], $maxSalesItemNumber, $minSalesItemNumber);
