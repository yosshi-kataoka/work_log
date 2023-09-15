<?php

namespace Poker;

interface CardRuleBase
{
  public function getHand(array $pokerCards);
}
