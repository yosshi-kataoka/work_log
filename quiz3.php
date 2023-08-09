<?php

// テレビのチャンネルの視聴時間を
// ターミナル上にて入力し、
// 合計視聴時間（hour表示で、小数点第２位を切り上げ）
// チャンネル番号 合計視聴時間（minute表示） 視聴回数
// のように出力する
// なお、チャンネル番号は1~12、視聴時間は1440まで入力可能とする
// データ構造
// [0]=>{[1] =>[min,min]} [1]=>{[3]=>[min,min]}...}
// この構造であれば、合計視聴時間、keyごとの視聴時間、視聴回数を出力することが可能
// 入力
// データを好ましい形にまとめる
// 合計時間をまとめる
// 表示

// データの入力
function getInputs(): array
{
  $removeLine = 1;
  $channelData = array_slice($_SERVER['argv'], $removeLine);
  $summarize = 2;
  $inputDate = array_chunk($channelData, $summarize);
  return $inputDate;
}

// $inputsの配列をkeyにチャンネル番号、valueに視聴時間となる配列に変換する
//
function getGroupingViewingParChannel(array $inputs): array
{
  $getGroupingViewingParChannel = [];
  foreach ($inputs as $keyChannel) {
    $channelNumber = $keyChannel[0];
    $channelMin = $keyChannel[1];
    $channelMins = [$channelMin];
    if (array_key_exists($channelNumber, $getGroupingViewingParChannel)) {
      $channelMins = array_merge($getGroupingViewingParChannel[$channelNumber], $channelMins);
    }
    $getGroupingViewingParChannel[$channelNumber] = $channelMins;
  }
  return $getGroupingViewingParChannel;
}

// $groupingViewingParChannelの配列から、合計視聴時間を返します。
function totalViewingTime(array $groupingViewingParChannel): float
{
  $getTotalTime = [];
  foreach ($groupingViewingParChannel as $viewingTimes) {
    $getTotalTime = array_merge($getTotalTime, $viewingTimes);
  }
  $totalViewingTime = array_sum($getTotalTime);
  $convertToHour = 60;
  return round(($totalViewingTime / $convertToHour), 1);
}

// 合計視聴時間、チャンネル番号ごとの視聴時間、視聴回数を出力
function display(array $groupingViewingParChannel): void
{
  $totalViewingTime = totalViewingTime($groupingViewingParChannel);
  echo (($totalViewingTime <= 24) ? $totalViewingTime . PHP_EOL : '合計視聴時間は1440分以下を入力してください' . PHP_EOL);
  foreach ($groupingViewingParChannel as $key => $value) {
    echo $key . ' ' . array_sum($value) . ' ' . count($value) . PHP_EOL;
  }
}

$inputs = getInputs();
$groupingViewingParChannel = getGroupingViewingParChannel($inputs);
display($groupingViewingParChannel);
