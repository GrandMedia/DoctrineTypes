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

	public function testValidation(): void
	{
		Assert::exception(
			function () {
				new Email('not email');
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_EMAIL
		);
	}

	public function testToString(): void
	{
		$email = new Email('foo@bar.cz');

		Assert::equal('foo@bar.cz', (string) $email);
	}

}

(new EmailTest())->run();
