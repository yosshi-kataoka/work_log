<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/market.php');

class marketTest extends TestCase
{
  public function testCalcRation()
  {
    $this->assertSame(1298, CalcRation('21:00', [1, 1, 1, 3, 5, 7, 8, 9, 10]));
  }
}
