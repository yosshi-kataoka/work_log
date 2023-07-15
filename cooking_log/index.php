<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '../../companies/lib/mysqli.php';

function ListFood($link)
{
  $foods = [];
  $sql = 'SELECT name,menu_Kind,score,recipe FROM cooking_log';
  $results = mysqli_query($link, $sql);

  while ($food = mysqli_fetch_assoc($results)) {
    $foods[] = $food;
  }
  mysqli_free_result($results);
  return $foods;
}
// データベースの接続
$link = dbConnect();
// データベースからデータを取得
$foods = ListFood($link);

$title = '料理の一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
