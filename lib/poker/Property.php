<?php

namespace Poker;

class Property
{
  public function __construct(private string $name, private int $handStrength, private int $primary, private int $secondary)
  {
  }

  public function getWinner(array $hand1, array $hand2): int
  {
    foreach (['handStrength', 'primary', 'secondary'] as $i) {
      if ($hand1[$i] > $hand2[$i]) {
        return 1;
      } elseif ($hand1[$i] < $hand2[$i]) {
        return 2;
      }
      return 0;
    }
  }
}
