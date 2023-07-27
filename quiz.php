<?php

const SPLIT_LENGTH = 2;
function getInput()
{
  $argument = (array_slice($_SERVER['argv'], 1));
  // [1, 30],[2,40]
  return array_chunk($argument, SPLIT_LENGTH);
}
function groupChannelViewingPeriods(array $inputs): array
{
  $ChannelViewingPeriods = [];
  foreach ($inputs as $input) {
    $chan = $input[0];
    $min = $input[1];
    $mins = [$min];
    // $minsを[$mins]と配列にすることで、同じチャンネルが出てきた際に配列内に格納できる
    if (array_key_exists($chan, $ChannelViewingPeriods)) {
      $mins = array_merge($ChannelViewingPeriods[$chan], $mins);
    }
    // $ChannelViewingPeriods[$chan]例えば、[1]=>{[0]=>30}に[0]=>15を追加した連想配列を$minsに代入して、下行でそれを新しく
    // $ChannelViewingPeriods[$chan]に代入することで、[1]={[0]=>30,[1]=>15}としている。
    $ChannelViewingPeriods[$chan] = $mins;
    // [1] =>{[0]=>30 [1]=>15} [5]=>{[0]=>15}
  }
  return $ChannelViewingPeriods;
}

function calculateTotalHour(array $ChannelViewingPeriods): float
{
  // 連想配列のままでは、値の合計ができないため、配列に作り直す必要がある。
  $viewingTimes = [];
  foreach ($ChannelViewingPeriods as $period) {
    $viewingTimes = array_merge($viewingTimes, $period);
  }
  // $viewingTimesには[0]=>30,[1]=>15,[2]=>30が格納されており、連想配列から配列に作り変えることができた。
  $totalMin = array_sum($viewingTimes);
  // 実は、32~37行目は下記のコマンドで一度に処理可能
  // array_sum(array_merge(...$channelViewingPeriods));
  // $channelViewingPeriodsの配列を展開して、それをmergeして値を合計している。
  return round($totalMin / 60, 1);
}

function display(array $channelViewingPeriods): void
{
  $totalHour = calculateTotalHour($channelViewingPeriods);
  echo $totalHour . PHP_EOL;
  foreach ($channelViewingPeriods as $chan => $mins) {
    echo $chan . ' ' . array_sum($mins) . ' ' . count($mins) . PHP_EOL;
  }
}
// 処理実行
$inputs = getInput();
$channelViewingPeriods = groupChannelViewingPeriods($inputs);
display($channelViewingPeriods);
