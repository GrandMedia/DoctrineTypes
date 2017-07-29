<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Percents;

use GrandMedia\DoctrineTypes\Percents\Percent;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class PercentTest extends \Tester\TestCase
{

	/**
	 * @dataProvider getValidPercents
	 * @param mixed $value
	 */
	public function testValidPercent($value, float $expected): void
	{
		$percent = new Percent($value);

		Assert::equal($expected, $percent->getValue());
	}

	/**
	 * @dataProvider getInvalidPercents
	 * @param mixed $value
	 * @throws \Assert\InvalidArgumentException
	 */
	public function testInvalidPercent($value): void
	{
		new Percent($value);
	}

	public function testAdd(): void
	{
		$percent = new Percent(50.5);

		$percentAdd = $percent->add(new Percent(30.75));

		Assert::true($percentAdd->equals(new Percent(81.25)));
	}

	public function testSubtract(): void
	{
		$percent = new Percent(50.5);

		$percentAdd = $percent->subtract(new Percent(30.75));

		Assert::true($percentAdd->equals(new Percent(19.75)));
	}

	public function testEquals(): void
	{
		$percent = new Percent(50.5);

		Assert::true($percent->equals(new Percent(50.5)));

		Assert::false($percent->equals(new Percent(50)));
		Assert::false($percent->equals(new Percent(51)));
	}

	public function testDecimal(): void
	{
		$percent = new Percent(50.5);

		Assert::same(0.505, $percent->getDecimal());
	}

	public function testToString(): void
	{
		$percent = new Percent(50.5);

		Assert::same('50.5', (string) $percent);
	}

	public function getValidPercents(): array
	{
		return [
			[
				'value' => 5,
				'expected' => 5.0,
			],
			[
				'value' => 4.669,
				'expected' => 4.67,
			],
			[
				'value' => 100.001,
				'expected' => 100.0,
			],
		];
	}

	public function getInvalidPercents(): array
	{
		return [
			[-4.69],
			[100.1],
		];
	}

}

(new PercentTest())->run();
