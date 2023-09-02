<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/vending_machine.php');

class VendingMachineTest extends TestCase
{
  function testPressButton()
  {
    $vendingMachine = new VendingMachine();
    $this->assertSame('cider', $vendingMachine->pressButton());
  }
}
