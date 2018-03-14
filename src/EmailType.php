<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use GrandMedia\VO\Email;

final class EmailType extends \Doctrine\DBAL\Types\StringType
{

	public const NAME = 'email';

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
	{
		$value = (string) $value;

		return $value === '' ? null : Email::from($value);
	}

	public function getName(): string
	{
		return self::NAME;
	}

	public function requiresSQLCommentHint(AbstractPlatform $platform): bool
	{
		return true;
	}

}
