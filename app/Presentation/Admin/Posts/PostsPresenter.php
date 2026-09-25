<?php

declare(strict_types=1);

namespace App\Presentation\Admin\Posts;

use App\Model\PostRepository;
use App\Presentation\Admin\BasePresenter;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;


final class PostsPresenter extends BasePresenter
{
	private const int ListLimit = 100;

	private ?ActiveRow $post = null;


	public function __construct(
		private readonly PostRepository $posts,
	) {
		parent::__construct();
	}


	public function renderDefault(): void
	{
		$this->template->posts = $this->posts->findLatest(self::ListLimit);
	}


	public function actionEdit(int $id): void
	{
		$this->post = $this->posts->get($id) ?? $this->error('Příspěvek nenalezen.');
		$this['postForm']->setDefaults(['content' => $this->post->content]);
	}


	public function renderEdit(): void
	{
		$this->template->post = $this->post;
	}


	public function handleDelete(int $id): void
	{
		$this->posts->delete($id);
		$this->flashMessage('Byl odstraněn příspěvek.');
		$this->redirect('this');
	}


	protected function createComponentPostForm(): Form
	{
		$form = new Form;
		$form->addTextArea('content', null, null, 12)
			->setRequired('Příspěvek nesmí být prázdný.');
		$form->addSubmit('send', 'uložit');
		$form->onSuccess[] = $this->postFormSucceeded(...);
		return $form;
	}


	private function postFormSucceeded(Form $form, \stdClass $data): void
	{
		$content = trim($data->content);
		if ($this->post) {
			$this->posts->update($this->post->id, $content);
			$this->flashMessage('Byl upraven příspěvek.');
		} else {
			$this->posts->insert($content);
			$this->flashMessage('Byl přidán příspěvek.');
		}

		$this->redirect('default');
	}
}
