<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Strings;

use Assert\Assertion;
use Nette\Utils\Callback;

final class NotBlankString
{

	/** @var string */
	private $value;

	public function __construct(string $value)
	{
		Assertion::notBlank($value);

		$this->value = $value;
	}

	public function modify(callable $function): self
	{
		return new self(Callback::invoke($function, $this->value));
	}

	public function __toString(): string
	{
		return $this->value;
	}

}
