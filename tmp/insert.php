<?php

$link = mysqli_connect('db', 'book_log', 'pass', 'book_log');

if (!$link) {
  echo 'ERROR: データベースに接続できませんでした' . PHP_EOL;
  echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
  exit;
}
echo 'データベースに接続できました' . PHP_EOL;

$sql = <<< EOT
  INSERT INTO memo(
    title =
  VALUES(

EOT;

mysqli_close($link);
echo 'データベースの接続を解除しました' . PHP_EOL;
