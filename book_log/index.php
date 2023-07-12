<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '../../companies/lib/mysqli.php';

function ListBook($link)
{
  $books = [];
  $sql = 'SELECT id,title,author,status,score,summary FROM book_log';
  $results = mysqli_query($link, $sql);

  while ($book = mysqli_fetch_assoc($results)) {
    $books[] = $book;
  }
  mysqli_free_result($results);
  return $books;
}
$link = dbConnect();
$books = ListBook($link);

$title = '読書ログの一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
