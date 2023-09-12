<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/CardRuleA.php');

class CardRuleATest extends TestCase
{
  public function testGetHand()
  {
    $rule = new CardRuleA;
    $this->assertSame('high card', $rule->getHand([new PokerCard('H5'), new PokerCard('C7')]));
    $this->assertSame('pair', $rule->getHand([new PokerCard('H9'), new PokerCard('C9')]));
    $this->assertSame('straight', $rule->getHand([new PokerCard('HA'), new PokerCard('CK')]));
    $this->assertSame('straight', $rule->getHand([new PokerCard('HA'), new PokerCard('C2')]));
  }
}
