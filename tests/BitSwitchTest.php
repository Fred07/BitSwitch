<?php

use fred\BitSwitch;
use PHPUnit\Framework\TestCase;

class BitSwitchTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_correct_status_of_option(): void
    {
        $bitValue = bindec(b'101');
        $bitSwitch = new BitSwitch($bitValue);
        $bitSwitch->setOption('first');
        $bitSwitch->setOption('second');
        $bitSwitch->setOption('third');

        $this->assertTrue($bitSwitch->isOptionOn('first'));
        $this->assertFalse($bitSwitch->isOptionOn('second'));
        $this->assertTrue($bitSwitch->isOptionOn('third'));
    }

    /**
     * @test
     */
    public function it_should_turn_on_value_of_option(): void
    {
        // prepare
        $bitValue = bindec(b'000');
        $bitSwitch = new BitSwitch($bitValue, ['first', 'second']);

        // test
        $bitSwitch->on('second');

        // assert
        $expected = bindec(b'010');
        $actual = $bitSwitch->getValue();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_should_turn_off_value_of_option(): void
    {
        // prepare
        $bitValue = bindec(b'110');
        $bitSwitch = new BitSwitch($bitValue, ['first', 'second', 'third']);

        // test
        $bitSwitch->off('third');
        $bitSwitch->off('first');

        // assert
        $expected = bindec(b'010');
        $actual = $bitSwitch->getValue();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function it_should_return_correct_binary_string(): void
    {
        // prepare
        $bitValue = bindec(b'1010');
        $bitSwitch = new BitSwitch($bitValue, ['a', 'b', 'c', 'd']);

        $expected = b'1010';

        // test
        $actual = (string) $bitSwitch;  // invoke __toString()

        // assert
        $this->assertEquals($expected, $actual);
    }
}