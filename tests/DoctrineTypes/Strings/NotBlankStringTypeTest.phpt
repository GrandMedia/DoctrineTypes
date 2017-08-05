<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Strings;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\Strings\NotBlankStringType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class NotBlankStringTypeTest extends \Tester\TestCase
{

	private const STRING = 'hello';

	public function testGetName(): void
	{
		$type = Type::getType(NotBlankStringType::NAME);

		Assert::same(NotBlankStringType::NAME, $type->getName());
	}

	public function testConvertToPHPValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(NotBlankStringType::NAME);

		Assert::same(self::STRING, (string) $type->convertToPHPValue(self::STRING, $platform));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(NotBlankStringType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(NotBlankStringType::NAME, NotBlankStringType::class);
	}

}

(new NotBlankStringTypeTest())->run();
