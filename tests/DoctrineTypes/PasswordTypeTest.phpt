<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\PasswordType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class PasswordTypeTest extends \Tester\TestCase
{

	private const HASH = 'hash';

	public function testConvertToPhpValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(PasswordType::NAME);

		Assert::same(self::HASH, (string) $type->convertToPHPValue(self::HASH, $platform));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testGetName(): void
	{
		$type = Type::getType(PasswordType::NAME);

		Assert::same(PasswordType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(PasswordType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(PasswordType::NAME, PasswordType::class);
	}

}

(new PasswordTypeTest())->run();
