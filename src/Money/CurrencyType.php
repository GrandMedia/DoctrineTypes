<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Money;

use Doctrine\DBAL\Platforms\AbstractPlatform;
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
		$value = (string) $value;

		return $value === '' ? null : new Currency($value);
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
