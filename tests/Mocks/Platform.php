<?php declare(strict_types = 1);

namespace GrandMediaTests\DoctrineTypes\Mocks;

final class Platform extends \Doctrine\DBAL\Platforms\AbstractPlatform
{

	/**
	 * @param string[] $columnDef
	 */
	public function getBooleanTypeDeclarationSQL(array $columnDef): string
	{
		return '';
	}

	/**
	 * @param string[] $columnDef
	 */
	public function getIntegerTypeDeclarationSQL(array $columnDef): string
	{
		return '';
	}

	/**
	 * @param string[] $columnDef
	 */
	public function getBigIntTypeDeclarationSQL(array $columnDef): string
	{
		return '';
	}

	/**
	 * @param string[] $columnDef
	 */
	public function getSmallIntTypeDeclarationSQL(array $columnDef): string
	{
		return '';
	}

	/**
	 * @param string[] $columnDef
	 */
	protected function _getCommonIntegerTypeDeclarationSQL(array $columnDef): string
	{
		return '';
	}

	protected function initializeDoctrineTypeMappings(): void
	{
	}

	/**
	 * @param string[] $field
	 */
	public function getClobTypeDeclarationSQL(array $field): string
	{
		return '';
	}

	/**
	 * @param string[] $field
	 */
	public function getBlobTypeDeclarationSQL(array $field): string
	{
		return '';
	}

	public function getName(): string
	{
		return '';
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 * @param int $length
	 * @param bool $fixed
	 */
	protected function getVarcharTypeDeclarationSQLSnippet($length, $fixed): string
	{
		return \sprintf('VARCHAR(%d)', $length);
	}

}
