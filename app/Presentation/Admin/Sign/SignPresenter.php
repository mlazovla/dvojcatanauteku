<?php

declare(strict_types=1);

namespace App\Presentation\Admin\Sign;

use Nette\Application\Attributes\Persistent;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Security\AuthenticationException;


final class SignPresenter extends Presenter
{
	#[Persistent]
	public string $backlink = '';


	public function actionOut(): void
	{
		$this->getUser()->logout(true);
		$this->flashMessage('Byli jste odhlášeni.');
		$this->redirect('in');
	}


	protected function createComponentSignInForm(): Form
	{
		$form = new Form;
		$form->addPassword('password', 'Autentizace:')
			->setRequired('Zadejte heslo.');
		$form->addSubmit('send', 'Přihlásit');
		$form->onSuccess[] = $this->signInFormSucceeded(...);
		return $form;
	}


	private function signInFormSucceeded(Form $form, \stdClass $data): void
	{
		try {
			$this->getUser()->login('admin', $data->password);
		} catch (AuthenticationException $e) {
			$form->addError($e->getMessage());
			return;
		}

		$this->restoreRequest($this->backlink);
		$this->redirect('Posts:');
	}
}
