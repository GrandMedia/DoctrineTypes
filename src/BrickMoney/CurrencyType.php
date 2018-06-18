<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\BrickMoney;

use Brick\Money\Currency;
use Doctrine\DBAL\Platforms\AbstractPlatform;

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

		return $value === '' ? null : Currency::of($value);
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
