<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\VO;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\VO\IBANType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class IBANTypeTest extends \Tester\TestCase
{

	private const IBAN = 'LC14BOSL123456789012345678901234';

	public function testConvertToPHPValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(IBANType::NAME);

		Assert::same(self::IBAN, (string) $type->convertToPHPValue(self::IBAN, $platform));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testGetName(): void
	{
		$type = Type::getType(IBANType::NAME);

		Assert::same(IBANType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(IBANType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(IBANType::NAME, IBANType::class);
	}

}

(new IBANTypeTest())->run();
