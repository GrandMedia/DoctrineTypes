<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Money;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use InvalidArgumentException;
use Money\Currency;

final class CurrencyType extends \Doctrine\DBAL\Types\Type
{

	public const NAME = 'currency';

	/**
	 * @param string[] $fieldDeclaration
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
	{
		return $platform->getVarcharTypeDeclarationSQL(
			[
				'length' => 3,
				'fixed' => true,
			]
		);
	}

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?Currency
	{
		$value = parent::convertToPHPValue($value, $platform);

		if ($value === '' || $value === null) {
			return null;
		}

		if ($value instanceof Currency) {
			return $value;
		}

		try {
			$currency = new Currency($value);
		} catch (InvalidArgumentException $exception) {
			throw ConversionException::conversionFailed($value, self::NAME);
		}

		return $currency;
	}

	/**
	 * @param mixed $value
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
	{
		$value = parent::convertToDatabaseValue($value, $platform);

		if ($value === '' || $value === null) {
			return null;
		}

		if ($value instanceof Currency) {
			return $value->getCode();
		}

		try {
			$currency = new Currency($value);
		} catch (InvalidArgumentException $exception) {
			throw ConversionException::conversionFailed($value, self::NAME);
		}

		return $currency->getCode();
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
