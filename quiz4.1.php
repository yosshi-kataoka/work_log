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
// 入力データ{[1]=>[volume,volume],[3]=>[volume,volume]...}
// 価格データ{[1]=100,[2]=120...[10]=300}
// TAX = 1.1
// 上記のデータ構造では、売上の合計金額、販売数量の最も多い商品・最も少ない商品を表示可能

// 入力データから[要素番号]=>[商品番号,販売数量]の配列を返す関数です。
const SPLIT_LENGTH = 2;
const TAX = 10;
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

// ターミナル上の入力値を[商品番号]=>[販売数量]として返す関数です。
function getInput(): array
{
  $argument = array_slice($_SERVER['argv'], 1);
  $args = array_chunk($argument, SPLIT_LENGTH);
  $sales = [];
  foreach ($args as $arg) {
    // $itemNumber = $arg[0];
    // $salesValue = $arg[1];
    // $salesValues = [$salesValue];
    // $salesValues = (int)[$arg[1]];
    // if (array_key_exists($arg[0], $sales)) {
    //   $salesValues = array_push($sales[$arg[0]], $salesValues);
    // }
    $sales[$arg[0]] = (int)$arg[1];
    // $sales[$arg[0]] = (int)$arg[1];
  }
  return $sales;
}

// $の配列を[商品番号]=>[販売数量、販売数量]の配列に変換して返す関数です。
function calculateSales(array $sales): int
{
  $sum = 0;
  foreach ($sales as $number => $unitsSold) {

    $sum += BREADS[$number] * (int)$unitsSold;
  }
  return (int)$sum * (100 + TAX) / 100;
}
// 商品の最大販売数量の商品を返す
function getNumbersOfMaxUnitsSold(array $sales): array
{
  $max = max(array_values($sales));
  return array_keys($sales, $max);
}

// 商品の最小販売数量の商品を返す
function getNumbersOfMinUnitsSold(array $sales): array
{
  $min = min(array_values($sales));
  return array_keys($sales, $min);
}

// 商品の合計金額、販売数量のトップ、ワーストをそれぞれ表示する。
function display(array ...$results): void
{
  foreach ($results as $result) {
    echo implode(' ', $result) . PHP_EOL;
  }
}

$sales = getInput();
$salesAmount = calculateSales($sales);
$numbersOfMaxUnitsSold = getNumbersOfMaxUnitsSold($sales);
$numbersOfMinUnitsSold = getNumbersOfMinUnitsSold($sales);
display([$salesAmount], $numbersOfMaxUnitsSold, $numbersOfMinUnitsSold);
