<?php

namespace BlackJack;

class HandEvaluator
{
  public function __construct(private StandardRule $rule)
  {
  }

  public function handJudge($players, Deck $deck): bool
  {
    return $this->rule->handJudge($players, $deck);
  }
}
