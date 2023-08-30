<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../lib/poker2.php');

class poker2Test extends TestCase
{
  public function testShowDown2()
  {

    $this->assertSame(['high card', 'pair', 2], showDown2('CK', 'DJ', 'C10', 'H10'));
    $this->assertSame(['high card', 'straight', 2], showDown2('CK', 'DJ', 'C3', 'H4'));
    $this->assertSame(['straight', 'pair', 1], showDown2('C3', 'H4', 'DK', 'SK'));
    $this->assertSame(['high card', 'high card', 1], showDown2('HJ', 'SK', 'DQ', 'D10'));
    $this->assertSame(['high card', 'high card', 2], showDown2('H9', 'SK', 'DK', 'D10'));
    $this->assertSame(['high card', 'high card', 0], showDown2('H3', 'S5', 'D5', 'D3'));
    $this->assertSame(['pair', 'pair', 1], showDown2('CA', 'DA', 'C2', 'D2'));
    $this->assertSame(['pair', 'pair', 2], showDown2('CK', 'DK', 'CA', 'DA'));
    $this->assertSame(['pair', 'pair', 0], showDown2('C4', 'D4', 'H4', 'S4'));
    $this->assertSame(['straight', 'straight', 1], showDown2('SA', 'DK', 'C2', 'CA'));
    $this->assertSame(['straight', 'straight', 2], showDown2('C2', 'CA', 'S2', 'D3'));
    $this->assertSame(['straight', 'straight', 0], showDown2('S2', 'D3', 'C2', 'H3'));
  }
}
