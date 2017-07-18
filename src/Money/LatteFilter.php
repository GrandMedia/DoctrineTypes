<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\Money;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

final class LatteFilter
{
	public function __invoke(Money $money, string $lang = 'cs_CZ'): string
	{
		$currencies = new ISOCurrencies();
		$formatter = new IntlMoneyFormatter(
			new \NumberFormatter($lang, \NumberFormatter::CURRENCY), $currencies
		);

		return $formatter->format($money);
	}
}
