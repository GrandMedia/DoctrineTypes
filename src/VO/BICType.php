<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use GrandMedia\VO\BIC;

final class BICType extends \Doctrine\DBAL\Types\StringType
{

	public const NAME = 'bic';
	public const DEFAULT_LENGTH = 11;

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?BIC
	{
		$value = (string) $value;

		return $value === '' ? null : BIC::from($value);
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
