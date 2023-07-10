<?php

require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/mysqli.php';

function ListCompanies($link)
{
  $companies = [];
  $sql = 'SELECT name,establishment_date,founder FROM companies ';
  $results = mysqli_query($link, $sql);

  while ($company = mysqli_fetch_assoc($results)) {
    $companies[] = $company;
  }
  mysqli_free_result($results);
  return $companies;
}
$link = dbConnect();
$companies = ListCompanies($link);

$title = '会社情報の一覧';
$content = __DIR__ . '/views/index.php';
include __DIR__ . '/views/layout.php';
