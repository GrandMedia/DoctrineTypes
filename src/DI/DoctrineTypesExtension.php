<?php declare(strict_types = 1);

namespace GrandMedia\DoctrineTypes\DI;

use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Nettrine\ORM\DI\Helpers\MappingHelper;

/**
 * @property-read \stdClass $config
 */
final class DoctrineTypesExtension extends \Nette\DI\CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure(
			[
				'registerFiles' => Expect::bool(false),
				'registerMoney' => Expect::bool(false),
				'registerVO' => Expect::bool(false),
			]
		);
	}

	public function beforeCompile(): void
	{
		$helper = MappingHelper::of($this);

		if ($this->config->registerFiles) {
			$helper->addXml('GrandMedia\Files', __DIR__ . '/../Files', true);
		}

		if ($this->config->registerMoney) {
			$helper->addXml('Brick\Money', __DIR__ . '/../Money', true);
		}

		if ($this->config->registerVO) {
			$helper->addXml('GrandMedia\VO', __DIR__ . '/../VO', true);
		}
	}

}
