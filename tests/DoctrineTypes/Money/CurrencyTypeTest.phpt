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

	private const CURRENCY = 'EUR';

	public function testGetSQLDeclaration(): void
	{
		$type = Type::getType(CurrencyType::NAME);

		Assert::same('VARCHAR(3)', $type->getSQLDeclaration([], new Platform()));
	}

	public function testConvertToPhpValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(CurrencyType::NAME);
		$currency = new Currency(self::CURRENCY);

		Assert::true($currency->equals($type->convertToPHPValue(self::CURRENCY, $platform)));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
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
