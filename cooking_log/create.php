 <link rel="stylesheet" href="stylesheets/css/app.css">
 <?php

  require_once __DIR__ . '/lib/mysqli.php';

  function createFood($link, $food)
  {
    $sql = <<<EOT
INSERT INTO cooking_log (
    name,
    menu_Kind,
    score,
    recipe
) VALUES (
    "{$food['name']}",
    "{$food['menu_kind']}",
    "{$food['score']}",
    "{$food['recipe']}"
)
EOT;
    $result = mysqli_query($link, $sql);
    if ($result) {
    } else {
      error_log('Error: fail to create food');
      error_log('Debugging Error:' . mysqli_error($link));
      echo 'Error:データの追加に失敗しました' . PHP_EOL;
      echo 'Debugging Error:' . mysqli_error($link) . PHP_EOL;
    }
  }
  // バリデーションの実装
  function validate($food)
  {
    $errors = [];
    //料理名
    if (!strlen($food['name'])) {
      $errors['name'] = '料理名を入力してください';
    } elseif (strlen($food['name']) > 255) {
      $errors['name'] = '料理名は255文字以内に入力してください';
    }
    //料理の種類
    $kind = ["japan", "western", "china"];
    if (!in_array($food['menu_kind'], $kind, true)) {
      $errors['menu_kind'] = '和食、洋食、中華より選択してください';
    }
    // 評価
    if (!(int)($food['score'])) {
      $errors['score'] = '1以上5以下の整数を入力してください';
    } elseif (1 > $food['score'] || 5 < $food['score']) {
      $errors['score'] = '1以上5以下の整数を入力してください';
    }
    // レシピ
    if (!strlen($food['recipe'])) {
      $errors['recipe'] = 'レシピを入力してください';
    } elseif (strlen($food['name']) > 1000) {
      $errors['name'] = 'レシピは1000文字以内に入力してください';
    }
    return $errors;
  }

  // ここから処理開始
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (array_key_exists('menu_kind', $_POST)) {
      $menu_kind = $_POST['menu_kind'];
    }
    $food = [
      'name' => $_POST['name'],
      'menu_kind' => $menu_kind,
      'score' => $_POST['score'],
      'recipe' => $_POST['recipe']
    ];

    // バリデーションする
    $errors = validate($food);
    if (!count($errors)) {
      //バリデーションがなければ
      $link = dbConnect();
      createFood($link, $food);
      mysqli_close($link);
      header("Location: index.php");
    }
    //もしえらーがあれば
  }
  $title = '料理の登録';
  $content = __DIR__ . "/views/new.php";
  include 'views/layout.php';
