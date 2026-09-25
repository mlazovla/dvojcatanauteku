<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;


final class PostRepository
{
	public function __construct(
		private readonly Explorer $database,
	) {
	}


	public function findLatest(int $limit): Selection
	{
		return $this->table()->order('id DESC')->limit($limit);
	}


	public function get(int $id): ?ActiveRow
	{
		return $this->table()->get($id);
	}


	public function insert(string $content): void
	{
		$this->table()->insert([
			'date' => new \DateTimeImmutable,
			'content' => $content,
		]);
	}


	public function update(int $id, string $content): void
	{
		$this->table()->where('id', $id)->update(['content' => $content]);
	}


	public function delete(int $id): void
	{
		$this->table()->where('id', $id)->delete();
	}


	private function table(): Selection
	{
		return $this->database->table('posts');
	}
}
