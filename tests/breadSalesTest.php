<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/breadSales.php');
class BreadSalesTest extends TestCase
{
  public function testDisplayResult()
  {
    $outputs = <<<EOD
    2464
    1
    5 10

    EOD;
    $this->expectOutputString($outputs);

    $sales = getDataInput(['file', '1', '10', '2', '3', '5', '1', '7', '5', '10', '1']);
    $totalPrice = getTotalPrice($sales);
    $maxSalesItemNumber = getMaxSalesItemNumber($sales);
    $minSalesItemNumber = getMinSalesItemNumber($sales);
    displayResult([$totalPrice], $maxSalesItemNumber, $minSalesItemNumber);
  }
}
