<?php

namespace Fred;

/**
 * Class BitSwitch
 * @package Fred
 */
class BitSwitch
{
    /**
     * binary format
     *
     * @var int
     */
    private const BASE = 2;

    /**
     * @var int
     */
    private $value;

    /**
     * @var
     */
    private $options;

    /**
     * @var int
     */
    private $nextPosCursor = 1;

    public function __construct(int $binaryVal = 0, array $options = [])
    {
        $this->value = $binaryVal;

        if (!empty($options)) {
            foreach ($options as $optName) {
                $this->setOption($optName);
            }
        }
    }

    /**
     * @param string $optName
     */
    public function setOption(string $optName): void
    {
        $this->options[$optName] = $this->nextPosCursor;
        $this->shiftCursor();
    }

    /**
     * @param string $optName
     * @return bool
     */
    public function isOptionExist(string $optName): bool
    {
        return array_key_exists($optName, $this->options);
    }

    /**
     * Switch bit on
     *
     * @param string $optName
     */
    public function on(string $optName): void
    {
        if ($this->isOptionExist($optName)) {
            $this->value |= $this->getBitValue($this->options[$optName]);
        }
    }

    /**
     * Switch bit off
     *
     * @param string $optName
     */
    public function off(string $optName): void
    {
        if ($this->isOptionExist($optName)) {
            $this->value &= $this->getMax() - $this->getBitValue($this->options[$optName]);
        }
    }

    /**
     * Get value of total bit combination
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param string $optName
     * @return bool
     */
    public function isOptionOn(string $optName): bool
    {
        if (array_key_exists($optName, $this->options)) {
            return $this->isOn($this->options[$optName]);
        }

        return false;
    }

    /**
     * @param int $bitPosition
     * @return bool
     */
    private function isOn(int $bitPosition): bool
    {
        return (bool) ($this->value & $this->getBitValue($bitPosition));
    }

    /**
     * @param int $bitPosition
     * @return int
     */
    private function getBitValue(int $bitPosition): int
    {
        if ($bitPosition === 1) {
            return 1;
        }

        return ($bitPosition - 1) * self::BASE;
    }

    private function shiftCursor(): void
    {
        ++$this->nextPosCursor;
    }

    /**
     * Get max value according options
     * @return int
     */
    private function getMax(): int
    {
        return (count($this->options) + 1) * self::BASE - 1;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return decbin($this->value);
    }
}

