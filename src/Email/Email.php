<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Email;

use Assert\Assertion;

final class Email
{
	/** @var string */
	private $value;

	public function __construct(string $value)
	{
		Assertion::email($value);

		$this->value = $value;
	}

	public function __toString(): string
	{
		return $this->value;
	}
}
