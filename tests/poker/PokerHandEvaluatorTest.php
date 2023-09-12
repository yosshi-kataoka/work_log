<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/PokerHandEvaluator.php');

class PokerHandEvaluatorTest extends TestCase
{
  public function testGetHand()
  {
    // カードが2枚の場合
    $handEvaluator = new PokerHandEvaluator(new CardRuleA());
    $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('SK')]));

    // カードが3枚の場合
    $handEvaluator = new PokerHandEvaluator(new CardRuleB());
    $this->assertSame('straight', $handEvaluator->getHand([new PokerCard('DA'), new PokerCard('S2'), new PokerCard('C3')]));
  }
}
