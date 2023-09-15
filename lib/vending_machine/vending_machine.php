<?php

namespace VendingMachine;

require_once('item.php');

class VendingMachine
{
  private const MAX_CUP_NUMBER = 100;

  private int $depositedCoin = 0;
  private int $cupNumber = 0;
  private int $depositNumber = 0;
  public function depositCoin(int $coinAmount): int
  {
    if ($coinAmount === 100) {
      $this->depositedCoin += $coinAmount;
    }

    return $this->depositedCoin;
  }

  public function pressButton(Item $item): string
  {
    $price = $item->getPrice();
    $cupNumber = $item->getCupNumber();
    $depositNumber = $item->depositItem();
    if ($this->depositedCoin >= $price && $this->cupNumber >= $cupNumber) {
      $this->depositedCoin -= $price;
      $this->cupNumber -= $cupNumber;
      $this->depositNumber = $depositNumber--;
      return $item->getName();
    } else {
      return '';
    }
  }

  public function addCup(int $num): int
  {
    $cupNumber = $this->cupNumber + $num;

    if ($cupNumber > self::MAX_CUP_NUMBER) {
      $cupNumber = self::MAX_CUP_NUMBER;
    }

    $this->cupNumber = $cupNumber;
    return $this->cupNumber;
  }

  public function receiveChange()
  {
    return $this->depositedCoin;
  }
  public function depositItem($item, $num): int
  {
    return $item->depositItem($item, $num);
  }
}
