<?php

namespace VendingMachine;

require_once('item.php');

class Snack extends Item
{
  private const PRICES = [
    'potato chips' => 150,
  ];
  private const MAX_ITEM_NUMBER = 50;
  private int $depositNumber = 0;

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

  public function depositItem($item, $num): int
  {
    $depositNumber = $this->depositNumber + $num;
    if ($depositNumber > self::MAX_ITEM_NUMBER) {
      $depositNumber = self::MAX_ITEM_NUMBER;
    }
    $this->depositNumber = $depositNumber;
    return $this->depositNumber;
  }
}
