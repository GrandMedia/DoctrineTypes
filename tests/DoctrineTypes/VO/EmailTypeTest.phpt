<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\VO;

use Doctrine\DBAL\Types\Type;
use GrandMedia\DoctrineTypes\VO\EmailType;
use GrandMediaTests\DoctrineTypes\Mocks\Platform;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class EmailTypeTest extends \Tester\TestCase
{

	private const EMAIL = 'email@email.cz';

	public function testConvertToPHPValue(): void
	{
		$platform = new Platform();
		$type = Type::getType(EmailType::NAME);

		Assert::same(self::EMAIL, (string) $type->convertToPHPValue(self::EMAIL, $platform));
		Assert::type('null', $type->convertToPHPValue('', $platform));
		Assert::type('null', $type->convertToPHPValue(null, $platform));
	}

	public function testGetName(): void
	{
		$type = Type::getType(EmailType::NAME);

		Assert::same(EmailType::NAME, $type->getName());
	}

	public function testRequiresSQLCommentHint(): void
	{
		$type = Type::getType(EmailType::NAME);

		Assert::true($type->requiresSQLCommentHint(new Platform()));
	}

	protected function setUp(): void
	{
		parent::setUp();

		Type::addType(EmailType::NAME, EmailType::class);
	}

}

(new EmailTypeTest())->run();
