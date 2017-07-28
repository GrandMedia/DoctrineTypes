<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Percents;

use GrandMedia\DoctrineTypes\Percents\Percent;
use InvalidArgumentException;
use Tester\Assert;
use Tester\TestCase;

require __DIR__ . '/../bootstrap.php';

/**
 * @testCase
 */
final class PercentTest extends TestCase
{
	public function testConstructWithGoodPercents()
	{
		$percent = new Percent(5);

		Assert::equal(5.0, $percent->getValue());

		$percent = new Percent(4.669);

		Assert::equal(4.67, $percent->getValue());
	}

	public function testConstructWithBadPercents()
	{
		foreach ([-4.69, 100.1] as $percent) {
			Assert::exception(
				function () use ($percent) {
					new Percent($percent);
				},
				InvalidArgumentException::class
			);
		}
	}

	public function testAdd()
	{
		$percent = new Percent(50.5);

		$percentAdd = $percent->add(new Percent(30.75));

		Assert::true($percentAdd->equals(new Percent(81.25)));

		Assert::exception(
			function () use ($percent) {
				$percent->add(new Percent(50));
			},
			InvalidArgumentException::class
		);
	}

	public function testSubtract()
	{
		$percent = new Percent(50.5);

		$percentAdd = $percent->subtract(new Percent(30.75));

		Assert::true($percentAdd->equals(new Percent(19.75)));

		Assert::exception(
			function () use ($percent) {
				$percent->subtract(new Percent(50.6));
			},
			InvalidArgumentException::class
		);
	}


	public function testEquals()
	{
		$percent = new Percent(50.5);

		Assert::true($percent->equals(new Percent(50.5)));

		Assert::false($percent->equals(new Percent(50)));
		Assert::false($percent->equals(new Percent(51)));
	}

	public function testDecimal()
	{
		$percent = new Percent(50.5);

		Assert::equal(0.505, $percent->getDecimal());
	}
}

(new PercentTest())->run();
