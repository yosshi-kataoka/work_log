<!-- 読書ログのトップページ -->
<?php
// $book = [
//   'title' => '',
//   'author' => '',
//   'status' => 'unread',
//   'score' => '',
//   'summary' => ''
// ];
$errors = [];
$containerLogos = ['レシピ紹介', 'ネットショップ', '業務用商品'];
$headerMenus = ['商品案内', 'マルエ品質', 'マルエ醤油株式会社', '会社情報', 'お問い合わせ'];
$itemLists = [
  'title' => '',
  'itemName' => '',
  'description' => '',
  'image' => ''
];
$title = 'マルエ醤油 - しょうゆ、みそ、しょんしょん';
$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
