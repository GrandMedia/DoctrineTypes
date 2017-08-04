<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Money;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\Money\CurrencyType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Money\Currency;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class CurrencyTypeTest extends \Tester\TestCase
{

	private const VALID_CURRENCY = 'EUR';
	private const INVALID_CURRENCY = 1;

	public function testGetSQLDeclaration(): void
	{
		$type = Type::getType(CurrencyType::NAME);

		Assert::same('VARCHAR(3)', $type->getSQLDeclaration([], new Platform()));
	}

	public function testConvertToPhpValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(CurrencyType::NAME);
		$currency = new Currency(self::VALID_CURRENCY);

		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
		Assert::same($currency, $type->convertToPHPValue($currency, $platform));
		Assert::true($currency->equals($type->convertToPHPValue(self::VALID_CURRENCY, $platform)));
	}

	/**
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertInvalidToPhpValue(): void
	{
		$type = Type::getType(CurrencyType::NAME);

		$type->convertToPHPValue(self::INVALID_CURRENCY, new Platform());
	}

	public function testConvertToDatabaseValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(CurrencyType::NAME);

		Assert::type('null', $type->convertToDatabaseValue('', $platform));
		Assert::type('null', $type->convertToDatabaseValue(null, $platform));
		Assert::same(
			self::VALID_CURRENCY,
			$type->convertToDatabaseValue(new Currency(self::VALID_CURRENCY), $platform)
		);
		Assert::same(self::VALID_CURRENCY, $type->convertToDatabaseValue(self::VALID_CURRENCY, $platform));
	}

	/**
	 * @throws \Doctrine\DBAL\Types\ConversionException
	 */
	public function testConvertInvalidToDatabaseValue(): void
	{
		$type = Type::getType(CurrencyType::NAME);

		$type->convertToDatabaseValue(self::INVALID_CURRENCY, new Platform());
	}

	public function testGetName(): void
	{
		$type = Type::getType(CurrencyType::NAME);

		Assert::same(CurrencyType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(CurrencyType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(CurrencyType::NAME, CurrencyType::class);
	}

}

(new CurrencyTypeTest())->run();
