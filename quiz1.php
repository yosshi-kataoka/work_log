<?php
// データ構造を決める
// [[1]=>[min,min],[5]=>[min,min]...]
// データの入力
// データの取得
// 望ましい形にデータを変換する
// データの表示

// 合計視聴時間(hour表示で、小数点第二位を切りすて)
// チャンネル チャンネル合計視聴時間（min） チャンネル視聴回数
// ...
const sliceLength = 2;
function getInput(): array
{
  $argument = array_slice($_SERVER['argv'], 1);
  $input = array_chunk($argument, sliceLength);
  return $input;
}

function parChannelTime(array $inputs): array
{
  $parChannelTimes = [];
  foreach ($inputs as $input) {
    $chan = $input[0];
    $min = $input[1];
    $mins = [$min];
    if (array_key_exists($chan, $parChannelTimes)) {
      $mins = array_merge($parChannelTimes[$chan], $mins);
    }

    $parChannelTimes[$chan] = $mins;
  }
  return $parChannelTimes;
}

function totalTime(array $parChannelTimes): float
{
  $parChannelTime = [];
  foreach ($parChannelTimes as $time) {
    $parChannelTime = array_merge($parChannelTime, $time);
  }
  $totalHour = array_sum($parChannelTime);
  $totalTimes = round(($totalHour / 60), 1);
  return $totalTimes;
}

function display($parChannelTimes): void
{
  $totalTimes = totalTime($parChannelTimes);
  echo $totalTimes . PHP_EOL;
  foreach ($parChannelTimes as $chan => $mins) {
    echo $chan . ' ' . array_sum($mins) . ' ' . count($parChannelTimes[$chan]) . PHP_EOL;
  }
}
$inputs = getInput();
$parChannelTimes = parChannelTime($inputs);
display($parChannelTimes);
