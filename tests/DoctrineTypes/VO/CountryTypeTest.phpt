<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\VO;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\VO\CountryType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class CountryTypeTest extends \Tester\TestCase
{

	private const COUNTRY = 'CZ';

	public function testGetSQLDeclaration(): void
	{
		$type = Type::getType(CountryType::NAME);

		Assert::same('VARCHAR(2)', $type->getSQLDeclaration([], new Platform()));
	}

	public function testConvertToPhpValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(CountryType::NAME);

		Assert::same(self::COUNTRY, (string) $type->convertToPHPValue(self::COUNTRY, $platform));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testGetName(): void
	{
		$type = Type::getType(CountryType::NAME);

		Assert::same(CountryType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(CountryType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(CountryType::NAME, CountryType::class);
	}

}

(new CountryTypeTest())->run();
