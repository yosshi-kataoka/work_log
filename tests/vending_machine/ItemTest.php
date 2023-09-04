<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/vending_machine/item.php');

class ItemTest extends TestCase
{
  public function testGetPrice()
  {
    $item = new Item('cider');
    $this->assertSame(100, $item->getPrice());
  }

  public function getName()
  {
    $item = new Item('cider');
    $this->assertSame('cider', $item->getName());
  }
}
