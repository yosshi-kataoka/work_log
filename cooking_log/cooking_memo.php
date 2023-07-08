<!-- テキスト上での料理メモプログラム -->
<?php

function createReview()
{
  echo '料理名：';
  $menu_name = trim(fgets(STDIN));
  echo '和洋中(和洋中より選択):';
  $menu_kind = trim(fgets(STDIN));
  echo 'メイン食材(肉魚野菜より選択):';
  $main_ingredients = trim(fgets(STDIN));
  echo '評価(整数5段階より選択):';
  $status = trim(fgets(STDIN));
  echo '料理のレシピを入力してください：';
  $recipe = trim(fgets(STDIN));
  echo '料理の登録が完了しました' . PHP_EOL . PHP_EOL;

  return [
    'menuName' => $menu_name,
    'menuKind' => $menu_kind,
    'mainIngredients' => $main_ingredients,
    'status' => $status,
    'recipe' => $recipe
  ];
}

function checkReview($reviews)
{
  foreach ($reviews as $review) {
    echo '料理名:' . $review['menuName'] . PHP_EOL;
    echo '和洋中:' . $review['menuKind'] . PHP_EOL;
    echo 'メイン食材:' . $review['mainIngredients'] . PHP_EOL;
    echo '評価:' . $review['status'] . PHP_EOL;
    echo 'レシピ:' . $review['recipe'] . PHP_EOL;
    echo '----------------' . PHP_EOL;
  };
}

$reviews = [];
$menu_name = '';
$menu_kind = '';
$main_ingredients = '';
$status = '';
$recipe = '';


while (true) {
  echo '処理を選択してください' . PHP_EOL;
  echo '1:料理の登録 2:料理の表示 9:アプリケーションの終了' . PHP_EOL;
  echo '選択する内容：';
  $num = trim(fgets(STDIN));

  if ($num === '1') {
    $reviews[] = createReview();
  } elseif ($num === '2') {
    checkReview($reviews);
  } elseif ($num === '9') {
    echo 'アプリケーションを終了します' . PHP_EOL . PHP_EOL;
    break;
  }
}

//2を選択した場合
//登録した料理の項目を料理ごとに表示
//9アプリケーションの終了
//アプリケーションを終了する
