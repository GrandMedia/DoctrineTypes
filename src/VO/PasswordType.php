<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\VO;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use GrandMedia\VO\Password;

final class PasswordType extends \Doctrine\DBAL\Types\StringType
{

	public const NAME = 'password';

	/**
	 * @param mixed $value
	 */
	public function convertToPHPValue($value, AbstractPlatform $platform): ?Password
	{
		$value = (string) $value;

		return $value === '' ? null : Password::fromHash($value);
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
