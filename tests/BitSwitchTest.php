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
        $bitSwitch->setOption('a');
        $bitSwitch->setOption('b');
        $bitSwitch->setOption('c');

        $this->assertTrue($bitSwitch->isOptionOn('a'));
        $this->assertFalse($bitSwitch->isOptionOn('b'));
        $this->assertTrue($bitSwitch->isOptionOn('c'));
    }

    /**
     * @test
     */
    public function it_should_turn_on_value_of_option(): void
    {
        // prepare
        $bitValue = bindec(b'000');
        $bitSwitch = new BitSwitch($bitValue, ['a', 'b']);

        // test
        $bitSwitch->on('b');

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
        $bitSwitch = new BitSwitch($bitValue, ['a', 'b', 'c']);

        // test
        $bitSwitch->off('c');
        $bitSwitch->off('a');

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

    /**
     * @test
     */
    public function it_should_return_correct_value_after_operates(): void
    {
        $bitSwitch = new BitSwitch(0, ['a', 'b', 'c']);

        $bitSwitch->on('a');
        $bitSwitch->on('c');

        $expected = bindec(b'101');
        $actual = $bitSwitch->getValue();

        $this->assertEquals($expected, $actual);
    }
}