<?php

declare(strict_types=1);

namespace App\Presentation\Front\Order;

use App\Model\OrderService;
use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;


final class OrderPresenter extends Presenter
{
	public function __construct(
		private readonly OrderService $orders,
	) {
		parent::__construct();
	}


	public function renderDefault(): void
	{
		$this->template->priceBook = $this->orders->getPriceBook();
		$this->template->pricePost = $this->orders->getPricePost();
	}


	protected function createComponentOrderForm(): Form
	{
		$labels = OrderService::Labels;
		$form = new Form;

		$form->addInteger('amount', $labels['amount'])
			->setDefaultValue(1)
			->setRequired('Vyplňte prosím %label.')
			->addRule($form::Range, 'Počet kusů musí být mezi %d a %d.', [1, 99])
			->setHtmlAttribute('min', 1)
			->setHtmlAttribute('max', 99);

		foreach (['name', 'surname', 'street', 'streetNo', 'city', 'zip'] as $field) {
			$form->addText($field, $labels[$field])
				->setRequired('Vyplňte prosím ' . $labels[$field] . '.')
				->addRule($form::MaxLength, null, 255);
		}

		$form->addText('country', $labels['country'])
			->setDefaultValue('Česká Republika')
			->setRequired('Vyplňte prosím ' . $labels['country'] . '.')
			->addRule($form::MaxLength, null, 255);
		$form->addText('phone', $labels['phone'])
			->setDefaultValue('+420')
			->addRule($form::MaxLength, null, 50);
		$form->addEmail('email', $labels['email'])
			->setRequired('Vyplňte prosím ' . $labels['email'] . '.');

		$form->addSubmit('sent', 'Zakoupit');
		$form->onSuccess[] = $this->orderFormSucceeded(...);
		return $form;
	}


	/** @param array<string, scalar> $values */
	private function orderFormSucceeded(Form $form, array $values): void
	{
		if ($values['phone'] === '+420') {
			$values['phone'] = '';
		}

		$this->orders->place($values);
		$this->redirect('thankyou');
	}
}
