<?php

namespace BlackJack;

interface Rule
{
  public function handJudge(array $players, Deck $deck): bool;
}
