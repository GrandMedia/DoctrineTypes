<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Money;

use GrandMedia\DoctrineTypes\Money\LatteFilter;
use Money\Currency;
use Money\Money;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

final class LatteFilterTest extends TestCase
{
	public function testInvoke()
	{
		$money = new Money(10000, new Currency('CZK'));

		Assert::equal('100,00 Kč', (new LatteFilter())($money));
		Assert::equal('CZK100.00', (new LatteFilter())($money, 'En_US'));
	}
}

(new LatteFilterTest())->run();
