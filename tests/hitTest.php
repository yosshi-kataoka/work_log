<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/hit.php');

class hitTest extends TestCase
{
  public function testJudge()
  {
    $this->assertSame([2, 2], judge(2345, 2354));
  }
}
