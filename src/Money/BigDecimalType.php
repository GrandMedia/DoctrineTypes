<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Money;

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
		$fieldDeclaration['precision'] = !isset($fieldDeclaration['precision']) || $fieldDeclaration['precision'] === ''
			? 20 : $fieldDeclaration['precision'];
		$fieldDeclaration['scale'] = !isset($fieldDeclaration['scale']) || $fieldDeclaration['scale'] === ''
			? 4 : $fieldDeclaration['scale'];

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
