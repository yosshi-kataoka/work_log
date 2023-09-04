<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/vending_machine.php');

class VendingMachineTest extends TestCase
{
  public function testDepositCoin()
  {
    $vendingMachine = new VendingMachine();
    $this->assertSame(0, $vendingMachine->depositCoin(0));
    $this->assertSame(0, $vendingMachine->depositCoin(150));
    $this->assertSame(100, $vendingMachine->depositCoin(100));
  }

  public function testPressButton()
  {
    $cider = new Item('cider');
    $cola = new Item('cola');

    $vendingMachine = new VendingMachine();

    # お金が投入されてない場合は購入できない
    $this->assertSame('', $vendingMachine->pressButton($cider));

    // 100円を入れた場合はサイダーを購入できる
    $vendingMachine->depositCoin(100);
    $this->assertSame('cider', $vendingMachine->pressButton($cider));

    // 100円しか入れていない場合はコーラが購入できない
    $vendingMachine->depositCoin(100);
    $this->assertSame('', $vendingMachine->pressButton($cola));

    // 200円を入れた場合はコーラを購入できる
    $vendingMachine->depositCoin(200);
    $this->assertSame('cola', $vendingMachine->pressButton($cola));
  }
}
