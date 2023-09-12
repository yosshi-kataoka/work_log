<?php

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../lib/poker/CardRuleB.php');

class CardRuleBTest extends TestCase
{
  public function testGetHand()
  {
    $rule = new CardRuleB;
    $this->assertSame('high card', $rule->getHand([new PokerCard('H5'), new PokerCard('C7'), new PokerCard('D3')]));
    $this->assertSame('high card', $rule->getHand([new PokerCard('HA'), new PokerCard('CK'), new PokerCard('D2')]));
    $this->assertSame('pair', $rule->getHand([new PokerCard('H5'), new PokerCard('C5'), new PokerCard('D3')]));
    $this->assertSame('straight', $rule->getHand([new PokerCard('HA'), new PokerCard('C2'), new PokerCard('D3')]));
    $this->assertSame('straight', $rule->getHand([new PokerCard('HA'), new PokerCard('CK'), new PokerCard('DQ')]));
    $this->assertSame('three card', $rule->getHand([new PokerCard('HA'), new PokerCard('CA'), new PokerCard('DA')]));
  }
}
