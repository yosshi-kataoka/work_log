<!-- databaseへの接続詳細を隠すための設定 -->
<?php

require __DIR__ . '/../../vendor/autoload.php';

function dbConnect()
{
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
  $dotenv->load();

  $dbHost = $_ENV['DB_HOST'];
  $dbUsername = $_ENV['DB_USERNAME'];
  $dbPassword = $_ENV['DB_PASSWORD'];
  $dbDatabase = $_ENV['DB_DATABASE'];

  $link = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbDatabase);
  if (!$link) {
    echo 'データベースの接続に失敗しました' . PHP_EOL;
    echo 'Debugging Error:' . mysqli_connect_error() . PHP_EOL;
    exit;
  }
  return $link;
}
