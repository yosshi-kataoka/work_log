<?php

namespace VendingMachine;

require_once('item.php');

class Drink extends Item
{
  private const PRICES = [
    'cider' => 100,
    'cola' => 150,
  ];
  private const MAX_ITEM_NUMBER = 50;
  public function __construct(string $name)
  {
    parent::__construct($name);
  }

  public function getPrice(): int
  {
    return self::PRICES[$this->name];
  }

  public function getCupNumber(): int
  {
    return 0;
  }

  public function getDepositNumber(): int
  {
    return 1;
  }
}
