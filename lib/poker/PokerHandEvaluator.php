<?php

require_once('PokerCard.php');

class PokerHandEvaluator
{
  public function __construct(private $rule)
  {
  }
  public function getHand(array $pokerCards): string
  {
    return $this->rule->getHand($pokerCards);
  }
}
