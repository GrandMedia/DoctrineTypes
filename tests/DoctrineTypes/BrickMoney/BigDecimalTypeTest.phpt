<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\BrickMoney;

use Brick\Math\BigDecimal;
use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\BrickMoney\BigDecimalType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class BigDecimalTypeTest extends \Tester\TestCase
{

	private const NUMBER = '123456789';

	public function testGetSQLDeclaration(): void
	{
		$type = Type::getType(BigDecimalType::NAME);

		Assert::same('NUMERIC(10, 0)', $type->getSQLDeclaration([], new Platform()));
	}

	public function testConvertToPhpValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(BigDecimalType::NAME);
		$number = BigDecimal::of(self::NUMBER);

		Assert::true($number->isEqualTo($type->convertToPHPValue(self::NUMBER, $platform)));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testGetName(): void
	{
		$type = Type::getType(BigDecimalType::NAME);

		Assert::same(BigDecimalType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(BigDecimalType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(BigDecimalType::NAME, BigDecimalType::class);
	}

}

(new BigDecimalTypeTest())->run();
