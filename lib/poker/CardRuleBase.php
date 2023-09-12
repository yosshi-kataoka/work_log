<?php

interface CardRuleBase
{
  public function getHand(array $pokerCards);
  public function isStraight(array $cards);
  public function isMinMax(array $cards);
}
