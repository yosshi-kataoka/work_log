<?php
// ◯インプット例
// 1 10 2 3 5 1 7 5 10 1
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

// @return array[商品番号=>販売数量,商品番号=>販売数量,...]
function getDataInput(array $argv): array
{
  $argument = array_slice($argv, 1);
  $args = array_chunk($argument, SPLIT_LENGTH);
  // var_dump($args);
  $sales = [];
  foreach ($args as $arg) {
    $sales[$arg[0]] = (int)$arg[1];
  }
  return $sales;
}

// @return totalPrice
function getTotalPrice(array $sales): int
{
  $sum = 0;
  foreach ($sales as $number => $volume) {
    $sum += BREADS[$number] * (int)$volume;
  }
  return (int)$sum * (100 + TAX) / 100;
}

// @return maxSalesItemNumber
function getMaxSalesItemNumber(array $sales): array
{ //テスト実行時にエラーが発生しないように、入力が空のときでも動作するよう、emptyの処理を実装
  if (empty($sales)) {
    return [];
  }
  $max = max(array_values($sales));
  return array_keys($sales, $max);
}

// @return minSalesItemNumber

function getMinSalesItemNumber(array $sales): array
{ //テスト実行時にエラーが発生しないように、入力が空のときでも動作するよう、emptyの処理を実装
  if (empty($sales)) {
    return [];
  }
  $min = min(array_values($sales));
  return array_keys($sales, $min);
}

// @display results

function displayResult(...$results): void
{
  foreach ($results as $result) {
    echo implode(' ', $result) . PHP_EOL;
  }
}

$sales = getDataInput($_SERVER['argv']);
$totalPrice = getTotalPrice($sales);
$maxSalesItemNumber = getMaxSalesItemNumber($sales);
$minSalesItemNumber = getMinSalesItemNumber($sales);
displayResult([$totalPrice], $maxSalesItemNumber, $minSalesItemNumber);
