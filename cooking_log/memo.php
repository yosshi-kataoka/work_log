<!-- テキスト料理メモプログラム
cooking_memo.phpファイルのデータベース実装version -->
<?php

use function PHPSTORM_META\sql_injection_subst;

function deConnect()
{
  $link = mysqli_connect('db', 'book_log', 'pass', 'book_log');
  if (!$link) {
    echo 'データベースの接続に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_connect_error() . PHP_EOL;
    exit;
  }
  return $link;
}

function validated($review)
{
  $errors = [];
  if (!mb_strlen($review['food'])) {
    $errors['food'] =  '料理名を入力してください';
  } elseif (mb_strlen($review['food']) > 50) {
    $errors['food'] =  '50文字以内で料理名を入力してください';
  }
  $food_kind = ['和', '洋', '中'];
  if (!(in_array($review['kind'], $food_kind, true))) {
    $errors['kind'] = '和、洋、中のいずれかを入力してください';
  }
  $main_foods = ['肉', '魚', '野菜'];
  if (!in_array($review['main_food'], $main_foods, true)) {
    $errors['main_food'] = '肉,魚,野菜より選択してください';
  }
  if (1 > $review['score'] || 5 < $review['score']) {
    $errors['score'] = '1以上5以下の整数を入力してください';
  }
  if (!(mb_strlen($review['recipe']))) {
    $errors['recipe'] = 'レシピを入力してください';
  } elseif (mb_strlen($review['recipe']) > 1000) {
    $errors['recipe'] = '1000文字以内でレシピを入力してください';
  }
  return $errors;
}

function createReview($link)
{
  $review = [];
  echo '料理名：';
  $review['food'] = trim(fgets(STDIN));

  echo '和洋中(和洋中より選択):';
  $review['kind'] = trim(fgets(STDIN));

  echo 'メイン食材(肉魚野菜より選択):';
  $review['main_food'] = trim(fgets(STDIN));

  echo '評価(整数5段階より選択):';
  $review['score'] = (int)trim(fgets(STDIN));

  echo '料理のレシピを入力してください：';
  $review['recipe'] = trim(fgets(STDIN));
  $validate = validated($review);
  if (count($validate) > 0) {
    echo 'Debugging Error' . PHP_EOL;
    foreach ($validate as $error_message) {
      echo $error_message . PHP_EOL;
    }
    echo PHP_EOL;
    return;
  }
  // echo '料理の登録が完了しました' . PHP_EOL . PHP_EOL;
  //料理の登録
  $sql = <<<EOM
  INSERT INTO memo(
    food,
    kinds,
    main_food,
    score,
    recipe)
    VALUES(
    "{$review['food']}",
    "{$review['kind']}",
    "{$review['main_food']}",
    "{$review['score']}",
    "{$review['recipe']}"
    )
  EOM;

  $results = mysqli_query($link, $sql);
  if ($results) {
    echo 'データの登録が完了しました' . PHP_EOL;
  } else {
    echo 'データの登録に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
  }
  // return [
  //   'food' => $food,
  //   'kinds' => $kinds,
  //   'mainFood' => $main_food,
  //   'score' => $score,
  //   'recipe' => $recipe
  // ];
}

function checkReview($link)
{
  echo '登録した料理を表示します';
  // $sql = "SELECT * FROM memo";
  $sql = "SELECT id,food,kinds,main_food,score,recipe FROM memo";
  $results = mysqli_query($link, $sql);
  while ($review_list = mysqli_fetch_assoc($results)) {
    echo '書籍名:' . $review_list['food'] . PHP_EOL;
    echo '料理の種類:' . $review_list['kinds'] . PHP_EOL;
    echo 'メイン食材:' . $review_list['main_food'] . PHP_EOL;
    echo '評価:' . $review_list['score'] . PHP_EOL;
    echo 'レシピ:' . $review_list['recipe'] . PHP_EOL;
    echo '----------------' . PHP_EOL;
  }
  // foreach ($reviews as $review) {
  //   echo '料理名:' . $review['food'] . PHP_EOL;
  //   echo '和洋中:' . $review['kinds'] . PHP_EOL;
  //   echo 'メイン食材:' . $review['mainFood'] . PHP_EOL;
  //   echo '評価:' . $review['score'] . PHP_EOL;
  //   echo 'レシピ:' . $review['recipe'] . PHP_EOL;
  //   echo '----------------' . PHP_EOL;
  // };
}

// $reviews = [];
// $food = '';
// $kinds = '';
// $main_food = '';
// $score = '';
// $recipe = '';
$link = dbConnect();

while (true) {
  echo '処理を選択してください' . PHP_EOL;
  echo '1:料理の登録' . PHP_EOL;
  echo '2:料理の表示' . PHP_EOL;
  echo '9:アプリケーションの終了' . PHP_EOL;
  echo '選択する内容：';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    // $reviews[] =
    createReview($link);
  } elseif ($num === '2') {
    checkReview($link);
  } elseif ($num === '9') {
    echo 'アプリケーションを終了します' . PHP_EOL . PHP_EOL;
    mysqli_close($link);
    // echo 'データベースとの接続を解除します';
    break;
  }
}

//2を選択した場合
//登録した料理の項目を料理ごとに表示
//9アプリケーションの終了
//アプリケーションを終了する
