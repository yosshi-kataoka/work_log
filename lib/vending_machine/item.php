<?php

namespace VendingMachine;

abstract class Item
{
  abstract public function getPrice();
  abstract public function getCupNumber();
  abstract public function depositItem();


  public function __construct(protected string $name)
  {
  }

  public function getName(): string
  {
    return $this->name;
  }
}
