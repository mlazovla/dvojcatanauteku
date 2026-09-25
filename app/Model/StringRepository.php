<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;


final class StringRepository
{
	public function __construct(
		private readonly Explorer $database,
	) {
	}


	/** @return array<string, string> */
	public function getValues(): array
	{
		return array_map(
			fn(?string $value): string => (string) $value,
			$this->table()->fetchPairs('code', 'value'),
		);
	}


	public function findAll(): Selection
	{
		return $this->table()->order('code');
	}


	public function get(string $code): ?ActiveRow
	{
		return $this->table()->get($code);
	}


	public function update(string $code, string $value): void
	{
		$this->table()->where('code', $code)->update(['value' => $value]);
	}


	private function table(): Selection
	{
		return $this->database->table('strings');
	}
}
