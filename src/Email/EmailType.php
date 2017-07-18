<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Email;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class EmailType extends StringType
{
	const NAME = 'email';

	public function getName(): string
	{
		return self::NAME;
	}

	public function convertToPHPValue($value, AbstractPlatform $platform): ?Email
	{
		$value = (string)$value;
		return $value === '' ? null : new Email($value);
	}

	public function requiresSQLCommentHint(AbstractPlatform $platform): bool
	{
		return true;
	}
}
