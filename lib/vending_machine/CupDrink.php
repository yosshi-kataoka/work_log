<?php

namespace VendingMachine;

require_once('item.php');

class CupDrink extends Item
{
  private const PRICES = [
    'ice cup coffee' => 100,
    'hot cup coffee' => 100,
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
    return 1;
  }

  public function getDepositNumber(): int
  {
    return 1;
  }
}
