<!-- 読書ログのトップページ -->
<?php
$book = [
  'title' => '',
  'author' => '',
  'status' => 'unread',
  'score' => '',
  'summary' => ''
];
$errors = [];
$title = '読書ログの登録';
$content = __DIR__ . '/views/new_book.php';
include __DIR__ . '/views/layout.php';
