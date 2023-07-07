<?php
require_once __DIR__ . '/companies/lib/mysqli.php';

function createList($link, $book)
{
  $sql = <<<EOT
INSERT INTO book_log(
  title,
  author,
  status,
  score,
  summary
) VALUES(
  "{$book['title']}",
  "{$book['author']}",
  "{$book['status']}",
  "{$book['score']}",
  "{$book['summary']}"
EOT;
  $result = mysqli_query($link, $sql);
  if ($result) {
  } else {
    error_log('fail to create book_log') . PHP_EOL;
    error_log('Debugging Error:' . mysqli_error($link)) . PHP_EOL;
  }
}

//バリデーション処理
function validate($book)
{
  $errors = [];
  if (!strlen($book['title'])) {
    $errors['title'] = '書籍名を入力してください';
  } elseif (strlen($book['title']) > 100) {
    $errors['title'] = '書籍名は100文字以内で入力してください';
  }
  if (!strlen($book['author'])) {
    $errors['author'] = '著者名を入力してください';
  } elseif (strlen($book['author']) > 100) {
    $errors['author'] = '著者名は100文字以内で入力してください';
  }
  $statuses = ["unread", "reading", "complete"];
  if (!in_array($book['status'], $statuses, true)) {
    $errors['status'] = '未読、読んでる、読了より選択してください';
  }
  if (!(int)($book['score'])) {
    $errors['score'] = '1以上5以下の整数を入力してください';
  } elseif (1 > $book['score'] || 5 < $book['score']) {
    $errors['score'] = '1以上5以下の整数を入力してください';
  }
  if (!strlen($book['summary'])) {
    $errors['summary'] = '感想を入力してください';
  } elseif (strlen($book['summary']) > 1000) {
    $errors['summary'] = '感想は1000文字以内で入力してください';
  }
  return $errors;
}
//データを受け取り、変数へ格納
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $status = [];
  if (array_key_exists('status', $_POST)) {
    $status = $_POST['status'];
  }
  $book = [
    'title' => $_POST['title'],
    'author' => $_POST['author'],
    'status' => $status,
    'score' => $_POST['score'],
    'summary' => $_POST['summary']
  ];
  //バリデーション処理
  $errors = validate($book);
  if (!count($errors)) {
    //データベース接続
    $link = dbConnect();
    //データベース追加
    createList($link, $book);
    //データベース解除
    mysqli_close($link);
    //リダイレクト
    header("Location:companies/index.php");
  }
}
//もしエラーがあったら下記の処理を行う
include 'views/new_book.php';
