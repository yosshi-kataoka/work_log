<?php

class Item
{
  private const PRICE =
  [
    'cider' => 100,
    'cola' => 150,
  ];

  public function __construct(private string $name)
  {
  }

  public function getPrice(): int
  {
    return self::PRICE[$this->name];
  }

  public function getName(): string
  {
    return $this->name;
  }
}
