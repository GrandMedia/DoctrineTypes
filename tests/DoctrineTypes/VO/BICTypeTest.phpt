<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\VO;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\VO\BICType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class BICTypeTest extends \Tester\TestCase
{

	private const BIC = 'DABAIE2D';

	public function testConvertToPHPValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(BICType::NAME);

		Assert::same(self::BIC, (string) $type->convertToPHPValue(self::BIC, $platform));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testGetName(): void
	{
		$type = Type::getType(BICType::NAME);

		Assert::same(BICType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(BICType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(BICType::NAME, BICType::class);
	}

}

(new BICTypeTest())->run();
