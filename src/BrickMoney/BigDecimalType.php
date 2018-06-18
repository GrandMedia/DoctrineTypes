<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\BrickMoney;

use Brick\Math\BigDecimal;
use Doctrine\DBAL\Platforms\AbstractPlatform;

final class BigDecimalType extends \Doctrine\DBAL\Types\Type
{

	public const NAME = 'big_decimal';

	/**
	 * @param string[] $fieldDeclaration
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
	{
		return $platform->getDecimalTypeDeclarationSQL($fieldDeclaration);
	}

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?BigDecimal
	{
		return $value === null ? null : BigDecimal::of($value);
	}

	/**
	 * @param mixed $value
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
	{
		if ($value instanceof BigDecimal) {
			return (string) $value;
		}

		return null;
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
