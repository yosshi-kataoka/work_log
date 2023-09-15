<?php

namespace Poker;

require_once('PokerCard.php');
class PokerHandEvaluator
{
  public function __construct(private $rule)
  {
  }
  public function getHand(array $pokerCards): array
  {
    return $this->rule->getHand($pokerCards);
  }
  public function getWinner(array $hand1, array $hand2): int
  {
    return $this->rule->getWinner($hand1, $hand2);
  }
}
