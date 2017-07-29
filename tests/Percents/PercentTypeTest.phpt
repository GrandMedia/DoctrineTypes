<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Percents;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\Percents\Percent;
use GrandMedia\DoctrineTypes\Percents\PercentType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class PercentTypeTest extends \Tester\TestCase
{

	private const VALID_PERCENT = 50.0;
	private const INVALID_TYPE_PERCENT = 'foo';
	private const INVALID_VALUE_PERCENT = 150.0;

	public function testGetSQLDeclaration(): void
	{
		$type = Type::getType(PercentType::NAME);

		Assert::same('NUMERIC(10, 2)', $type->getSQLDeclaration([], new Platform()));
	}

	public function testConvertToPhpValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(PercentType::NAME);
		$percent = new Percent(self::VALID_PERCENT);

		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
		Assert::same($percent, $type->convertToPHPValue($percent, $platform));
		Assert::true($percent->equals($type->convertToPHPValue(self::VALID_PERCENT, $platform)));
	}

	/**
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertInvalidTypeToPhpValue(): void
	{
		$type = Type::getType(PercentType::NAME);

		$type->convertToPHPValue(self::INVALID_TYPE_PERCENT, new Platform());
	}

	/**
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertInvalidValueToPhpValue(): void
	{
		$type = Type::getType(PercentType::NAME);

		$type->convertToPHPValue(self::INVALID_VALUE_PERCENT, new Platform());
	}

	public function testConvertToDatabaseValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(PercentType::NAME);

		Assert::type('null', $type->convertToDatabaseValue('', $platform));
		Assert::type('null', $type->convertToDatabaseValue(null, $platform));
		Assert::same(
			self::VALID_PERCENT,
			$type->convertToDatabaseValue(new Percent(self::VALID_PERCENT), $platform)
		);
		Assert::same(self::VALID_PERCENT, $type->convertToDatabaseValue(self::VALID_PERCENT, $platform));
	}

	/**
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertInvalidToDatabaseValue(): void
	{
		$type = Type::getType(PercentType::NAME);

		$type->convertToDatabaseValue(self::INVALID_TYPE_PERCENT, new Platform());
	}

	/**
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertInvalidValueToDatabaseValue(): void
	{
		$type = Type::getType(PercentType::NAME);

		$type->convertToDatabaseValue(self::INVALID_VALUE_PERCENT, new Platform());
	}

	public function testGetName(): void
	{
		$type = Type::getType(PercentType::NAME);

		Assert::same(PercentType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(PercentType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(PercentType::NAME, PercentType::class);
	}

}

(new PercentTypeTest())->run();
