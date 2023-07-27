<?php
// $errors = [];
// $totalTime = 0;
// $chList = [
//   'number' => '',
//   'time' => '',
//   'count' => ''
// ];
// $end = 0;
// // 入力したch番号のエラー処理
// function errorCheck($chList)
// {
//   if (!is_numeric($chList['number']) || $chList['number'] < 1 || $chList['number'] > 12) {
//     echo "1から12までの整数を入力してください" . PHP_EOL;
//     $errors['number'] = "1から12までの整数を入力してください";
//   }
//   if (!is_numeric($chList['time']) || 1 > $chList['time'] || 1440 < $chList['time']) {
//     echo "1から1440までの数字を入力してください" . PHP_EOL;
//     $errors['time'] = "1から1440までの数字を入力してください";
//   }
//   return $errors;
// }

// // 実行内容
// while ($end === 0) {
//   // chの登録
//   echo "1から12までのどのチャンネルを視聴しましたか" . PHP_EOL;
//   $chList['number'] = trim(fgets(STDIN));
//   // 視聴時間の登録
//   echo "そのチャンネルを何分視聴しましたか" . PHP_EOL;
//   $chList['time'] = trim(fgets(STDIN));
//   // 視聴回数のカウント
//   $chList['count']++;
//   // バリデーション処理
//   $errors = errorCheck($chList);
//   var_dump($errors);
//   if (count($errors) > 0) {
//     echo $errors;
//     continue;
//   }
//   $chLists[] = $chList;
//   var_dump($chLists);
//   // 結果を出力して終了
//   $end = 1;
// }
// // echo $totalTime . EOL;
// foreach($chList as$chList)



// 回答
function getInput()
{
  var_dump(array_slice($_SERVER['argv'], 1));
}
$inputs = getInput();
