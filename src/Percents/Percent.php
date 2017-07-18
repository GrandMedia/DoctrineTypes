<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Percents;

use Assert\Assertion;

final class Percent
{
	/** @var float */
	private $value;

	public function __construct(float $value)
	{
		$value = round($value, 2);

		Assertion::between($value, 0.0, 100.0);

		$this->value = $value;
	}

	public function add(Percent $percent): self
	{
		return new self($this->value + $percent->value);
	}

	public function subtract(Percent $percent): self
	{
		return new self($this->value - $percent->value);
	}

	public function equals(Percent $percent): bool
	{
		return $this->value === $percent->value;
	}

	public function getValue(): float
	{
		return $this->value;
	}

	public function getDecimal(): float
	{
		return $this->value / 100;
	}

	function __toString(): string
	{
		return (string)$this->value;
	}
}
