<?php

$count = 0;

function test($count)
{
  $count++;
  echo $count;
  if ($count < 10) {
    test($count);
  }
}
test($count);
# 期待している実行結果 → 12345678910
# 実際の実行結果 → Warning: Undefined variable $count
