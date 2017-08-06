<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Strings;

use Assert\Assertion;
use GrandMedia\DoctrineTypes\Strings\NotBlankString;
use InvalidArgumentException;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class NotBlankStringTest extends \Tester\TestCase
{

	private const STRING = 'hello';

	public function testValidation(): void
	{
		Assert::exception(
			function () {
				new NotBlankString('');
			},
			InvalidArgumentException::class,
			null,
			Assertion::INVALID_NOT_BLANK
		);
	}

	public function testModify(): void
	{
		$string = new NotBlankString(self::STRING);

		$modifiedString = $string->modify(
			function (string $string) {
				return \substr($string, 3);
			}
		);
		Assert::same('lo', (string) $modifiedString);
	}

	public function testToString(): void
	{
		$string = new NotBlankString(self::STRING);

		Assert::equal(self::STRING, (string) $string);
	}

}

(new NotBlankStringTest())->run();
