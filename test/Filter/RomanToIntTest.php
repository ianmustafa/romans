<?php

namespace RomansTest\Filter;

use PHPUnit\Framework\TestCase;
use Romans\Filter\RomanToInt;
use Romans\Lexer\Lexer;
use Romans\Parser\Parser;

/**
 * Roman to Int Test
 */
class RomanToIntTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->filter = new RomanToInt();
    }

    /**
     * Test Constructor
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(Lexer::class, $this->filter->getLexer());
        $this->assertInstanceOf(Parser::class, $this->filter->getParser());

        $this->assertSame(
            $this->filter->getLexer()->getGrammar(),
            $this->filter->getParser()->getGrammar()
        );
    }

    /**
     * Test Filter
     */
    public function testFilter()
    {
        $this->assertSame(1, $this->filter->filter('I'));
        $this->assertSame(5, $this->filter->filter('V'));
        $this->assertSame(10, $this->filter->filter('X'));
    }

    /**
     * Test Filter with Multiple
     */
    public function testFilterWithMultiple()
    {
        $this->assertSame(68, $this->filter->filter('LXVIII'));
        $this->assertSame(1537, $this->filter->filter('MDXXXVII'));
    }

    /**
     * Test Filter with Lookahead
     */
    public function testFilterWithLookahead()
    {
        $this->assertSame(4, $this->filter->filter('IV'));
        $this->assertSame(9, $this->filter->filter('IX'));
        $this->assertSame(40, $this->filter->filter('XL'));
    }

    /**
     * Test Filter with Multiple Lookahead
     */
    public function testFilterWithMultipleLookahead()
    {
        $this->assertSame(469, $this->filter->filter('CDLXIX'));
        $this->assertSame(1999, $this->filter->filter('MCMXCIX'));
    }
}
