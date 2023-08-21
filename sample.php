<?php

$items = [
  ['name' => 'onion', 'price' => 100],
];
$total = 0;
foreach ($items as $item) {
  $price = $item['price'];
  $total += $price;
}

料金の取得
料金の合計
