<!-- cookingメモサイトのトップページ -->
<?php
$food = [
  'name' => '',
  'menu_kind' => 'japan',
  'score' => '',
  'recipe' => ''
];
$errors = [];
$title = '料理メモの登録';
$content = __DIR__ . '/views/new.php';
include  __DIR__ . '/views/layout.php';
