<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use GrandMedia\VO\IBAN;

final class IBANType extends \Doctrine\DBAL\Types\StringType
{

	public const NAME = 'iban';
	public const DEFAULT_LENGTH = 34;

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?IBAN
	{
		$value = (string) $value;

		return $value === '' ? null : IBAN::from($value);
	}

	public function getName(): string
	{
		return self::NAME;
	}

	public function getDefaultLength(AbstractPlatform $platform): int
	{
		return self::DEFAULT_LENGTH;
	}

	public function requiresSQLCommentHint(AbstractPlatform $platform): bool
	{
		return true;
	}

}
