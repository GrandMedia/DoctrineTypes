<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Percents;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use InvalidArgumentException;

final class PercentType extends \Doctrine\DBAL\Types\Type
{

	public const NAME = 'percent';

	/**
	 * @param string[] $fieldDeclaration
	 */
	public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform): string
	{
		return $platform->getDecimalTypeDeclarationSQL(
			[
				'precision' => 10,
				'scale' => 2,
			]
		);
	}

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?Percent
	{
		$value = parent::convertToPHPValue($value, $platform);

		if ($value === '' || $value === null) {
			return null;
		}

		if ($value instanceof Percent) {
			return $value;
		}

		try {
			$percent = new Percent($value);
		} catch (InvalidArgumentException $exception) {
			throw ConversionException::conversionFailed($value, self::NAME);
		} catch (\TypeError $exception) {
			throw ConversionException::conversionFailed($value, self::NAME);
		}

		return $percent;
	}

	/**
	 * @param mixed $value
	 */
	public function convertToDatabaseValue($value, AbstractPlatform $platform): ?float
	{
		$value = parent::convertToDatabaseValue($value, $platform);

		if ($value === '' || $value === null) {
			return null;
		}

		if ($value instanceof Percent) {
			return $value->getValue();
		}

		try {
			$percent = new Percent($value);
		} catch (InvalidArgumentException $exception) {
			throw ConversionException::conversionFailed($value, self::NAME);
		} catch (\TypeError $exception) {
			throw ConversionException::conversionFailed($value, self::NAME);
		}

		return $percent->getValue();
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
