<?php
// 2.5
// 1 30 2
// 5 20 1 ...

// データ構造
// [[1] =>[min,min],[5]=>[min,min]...]
// データの入力
// データの取得
// チャンネルごとの視聴時間、合計時間、視聴回数
// データの表示
function getInput()
{
  $argument = array_slice($_SERVER['argv'], 1);
  $inputs = array_chunk($argument, 2);
  return $inputs;
}

function timeParChannel(array $inputs): array
{
  $timeParChannel = [];
  foreach ($inputs as $input) {
    $chan = $input[0];
    $min = $input[1];
    $mins = [$min];
    if (array_key_exists($chan, $timeParChannel)) {
      $mins = array_merge($timeParChannel[$chan], $mins);
    }
    $timeParChannel[$chan] = $mins;
  }
  return $timeParChannel;
}

function totalViewingTime(array $timeParChannel): float
{
  $totalTimes = [];
  foreach ($timeParChannel as $time) {
    $totalTimes = array_merge($totalTimes, $time);
  }
  $totalTime = array_sum($totalTimes);
  $totalHour = round(($totalTime / 60), 1);
  return $totalHour;
}

function getChannelViewingTime(array $timeParChannel): void
{
  $totalHour = totalViewingTime($timeParChannel);
  echo $totalHour . PHP_EOL;
  foreach ($timeParChannel as $chan => $mins) {
    echo $chan . ' ' . array_sum($mins) . ' ' . count($timeParChannel[$chan]) . PHP_EOL;
  }
}
$inputs = getInput();
$timeParChannel = timeParChannel($inputs);
getChannelViewingTime($timeParChannel);
