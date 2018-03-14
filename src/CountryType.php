<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use GrandMedia\VO\Country;

final class CountryType extends \Doctrine\DBAL\Types\Type
{

	public const NAME = 'country';

	/**
	 * @param string[] $fieldDeclaration
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
	{
		return $platform->getVarcharTypeDeclarationSQL(
			[
				'length' => 2,
				'fixed' => true,
			]
		);
	}

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?Country
	{
		$value = (string) $value;

		return $value === '' ? null : Country::fromCode($value);
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
