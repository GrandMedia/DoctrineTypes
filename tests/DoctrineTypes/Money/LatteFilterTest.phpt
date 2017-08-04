<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Money;

use GrandMedia\DoctrineTypes\Money\LatteFilter;
use Money\Currency;
use Money\Money;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

/**
 * @testCase
 */
final class LatteFilterTest extends \Tester\TestCase
{

	public function testInvoke(): void
	{
		$money = new Money(10000, new Currency('CZK'));

		Assert::equal('100,00 Kč', (new LatteFilter())($money));
		Assert::equal('CZK100.00', (new LatteFilter())($money, 'En_US'));
	}

}

(new LatteFilterTest())->run();
