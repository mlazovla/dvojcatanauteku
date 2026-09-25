<?php

declare(strict_types=1);

namespace App\Presentation\Admin\Slides;

use App\Model\StringRepository;
use App\Presentation\Admin\BasePresenter;
use Nette\Application\UI\Form;
use Nette\Database\Table\ActiveRow;


final class SlidesPresenter extends BasePresenter
{
	private ActiveRow $string;


	public function __construct(
		private readonly StringRepository $strings,
	) {
		parent::__construct();
	}


	public function renderDefault(): void
	{
		$this->template->strings = $this->strings->findAll();
	}


	public function actionEdit(string $id): void
	{
		$this->string = $this->strings->get($id) ?? $this->error('Text nenalezen.');
		$this['editForm']->setDefaults(['value' => $this->string->value]);
	}


	public function renderEdit(): void
	{
		$this->template->string = $this->string;
	}


	protected function createComponentEditForm(): Form
	{
		$form = new Form;
		$form->addTextArea('value', null, null, 12);
		$form->addSubmit('send', 'uložit');
		$form->onSuccess[] = function (Form $form, \stdClass $data): void {
			$this->strings->update($this->string->code, $data->value);
			$this->flashMessage("Byl upraven text {$this->string->code}.");
			$this->redirect('default');
		};
		return $form;
	}
}
