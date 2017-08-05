<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Email;

use Assert\Assertion;
use GrandMedia\DoctrineTypes\Email\Email;
use InvalidArgumentException;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class EmailTest extends \Tester\TestCase
{

	private const VALID_EMAIL = 'foo@bar.cz';
	private const INVALID_EMAIL = 'not email';

	public function testValidation(): void
	{
		Assert::exception(
			function () {
				new Email(self::INVALID_EMAIL);
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_EMAIL
		);
	}

	public function testToString(): void
	{
		$email = new Email(self::VALID_EMAIL);

		Assert::equal(self::VALID_EMAIL, (string) $email);
	}

}

(new EmailTest())->run();
