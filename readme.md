# BitSwitch

[![Build Status](https://travis-ci.com/Fred07/BitSwitch.svg?branch=master)](https://travis-ci.com/Fred07/BitSwitch)

BitSwitch is a bit-mask structure handler

## Information

For example, given a binary string `0101`

each bit present a option is on or off.

using the converted value from binary to integer to present the final options state.

As above, `0101` present d,c,b,a options in order.

5 (int) is the value after convert from binary `0101`

in this case, 5 means option a and option c is on, option b and option d is off. 

## Example

### with initial value

extends from example above

```php
$bitSwitch = new BitSwitch(0, ['a', 'b', 'c', 'd']);
$bitSwitch->on('a');
$bitSwitch->on('c');
$result = $bitSwitch->getValue();   // $result = 5
```