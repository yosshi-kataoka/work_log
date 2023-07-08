<?php

function validate($review)
{
  $errors = [];

  //書籍名が正しく入力されているかをチェック
  if (!mb_strlen($review['title'])) {
    $errors['title'] = '書籍名を入力してください';
  } elseif (mb_strlen($review['title'] > 255)) {
    $errors['title'] = '書籍名は255文字以内で入力してください';
  }
  //評価が正しく入力されているかチェック
  if ($review['score'] < 1 || $review['score'] > 5) {
    $errors['score'] = '1以上5以下の整数を入力してください';
  }
  if (!mb_strlen($review['author'])) {
    $errors['author'] = '著者名を入力してください';
  } elseif (strlen($review['author']) > 255) {
    $errors['author'] = '著者名は255文字以内で入力してください';
  }
  $status_list = ["未読", "読んでる", "読了"]; //チェックする文字列
  if (!(in_array($review['status'], $status_list, true))) {
    $errors['status'] = '未読、読んでる、読了のいずれかを入力してください';
  }
  if (!mb_strlen($review['summary'])) {
    $errors['summary'] = '感想を入力してください';
  } elseif (mb_strlen($errors['summary']) > 500) {
    $errors['summary'] = '感想は500文字以内で入力してください';
  }
  return  $errors;
}

function dbConnect()
{
  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
  if (!$link) {
    echo 'データベースに接続できません' . PHP_EOL;
    echo 'Debugging error :' . mysqli_connect_error() . PHP_EOL;
    exit;
  }
  // echo 'データベースに接続できました' . PHP_EOL;
  return $link;
}

function createReview($link)
{
  $review = [];
  echo '読書ログを登録してください' . PHP_EOL;
  echo '書籍名: ';
  $review['title'] = trim(fgets(STDIN));

  echo '著者名: ';
  $review['author'] = trim(fgets(STDIN));

  echo '読書状況(未読,読んでる,読了):';
  $review['status'] = trim(fgets(STDIN));

  echo '評価(５点満点の整数):';
  $review['score'] = (int)(trim(fgets(STDIN)));

  echo '感想:';
  $review['summary'] = trim(fgets(STDIN));

  $validated = validate($review);
  if (count($validated) > 0) {
    foreach ($validated as $error) {
      echo $error . PHP_EOL;
    }
    return;
  }

  $sql = <<<DOT
INSERT INTO book_log(
    title,
    author,
    status,
    score,
    summary
  )VALUES (
    "{$review['title']}",
    "{$review['author']}",
    "{$review['status']}",
    "{$review['score']}",
    "{$review['summary']}"
)
DOT;

  $result = mysqli_query($link, $sql);
  if ($result) {
    echo 'データを追加しました' . PHP_EOL;
  } else {
    echo 'データの追加に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
  }
  echo '登録が完了しました' . PHP_EOL .  PHP_EOL;

  // return [
  //   'title' => $title,
  //   'author' => $author,
  //   'status' => $status,
  //   'score' => $score,
  //   'summary' => $summary
  // ];
}

function listReviews($link)
{
  echo '読書ログを表示します' . PHP_EOL;
  $sql = 'SELECT id,title,author,status,score,summary FROM book_log';
  $results = mysqli_query($link, $sql);
  while ($lists = mysqli_fetch_assoc($results)) {
    echo '書籍名: ' . $lists['title'] . PHP_EOL;
    echo '著者名: ' . $lists['author'] . PHP_EOL;
    echo '読書状況: ' . $lists['status'] . PHP_EOL;
    echo '評価: ' . $lists['score'] . PHP_EOL;
    echo '感想: ' . $lists['summary'] . PHP_EOL;
    echo '----------------' . PHP_EOL;
  }
  mysqli_free_result($results);
  // echo '読書ログを表示します' . PHP_EOL;
  // foreach ($reviews as $review) {
  //   echo '書籍名: ' . $review['title'] . PHP_EOL;
  //   echo '著者名: ' . $review['author'] . PHP_EOL;
  //   echo '読書状況: ' . $review['status$status'] . PHP_EOL;
  //   echo '評価: ' . $review['score'] . PHP_EOL;
  //   echo '感想: ' . $review['summary'] . PHP_EOL;
  //   echo '----------------' . PHP_EOL;
  // };
}

//プログラム記述

$link = dbConnect();
// $reviews = [];
$title = '';
$author = '';
$status = '';
$score = '';
$summary = '';
while (true) {
  echo '1. 読書ログを登録' . PHP_EOL;
  echo '2. 読書ログを表示' . PHP_EOL;
  echo '9. アプリケーションを終了' . PHP_EOL;
  echo '番号を選択してください(1,2,9) :';
  $num = trim(fgets(STDIN));

  if ($num === '1') {

    // $review[] =
    createReview($link);
    //TODO：あとで削除する

  } elseif ($num === '2') {
    listReviews($link);
  } elseif ($num === '9') {
    // アプリケーションを終了する
    mysqli_close($link);
    echo 'データベースを切断しました' . PHP_EOL;
    break;
  }
}
// echo '著者名:宮沢賢治' . PHP_EOL;
// echo '読書状況:読了' . PHP_EOL;
// echo '評価:5' . PHP_EOL;
// echo '感想:ほんとうの幸せとは何だろうかと考えさせられる作品だった。' . PHP_EOL; */
