<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Strings;

use Doctrine\DBAL\Platforms\AbstractPlatform;

final class NotBlankStringType extends \Doctrine\DBAL\Types\StringType
{

	public const NAME = 'notBlankString';

	public function getName(): string
	{
		return self::NAME;
	}

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?NotBlankString
	{
		$value = (string) $value;

		return $value === '' ? null : new NotBlankString($value);
	}

	public function requiresSQLCommentHint(AbstractPlatform $platform): bool
	{
		return true;
	}

}
