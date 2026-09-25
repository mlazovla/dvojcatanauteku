<?php

declare(strict_types=1);

namespace App\Presentation\Admin\Orders;

use App\Model\OrderService;
use App\Presentation\Admin\BasePresenter;


final class OrdersPresenter extends BasePresenter
{
	private const int ListLimit = 100;


	public function __construct(
		private readonly OrderService $orders,
	) {
		parent::__construct();
	}


	public function renderDefault(): void
	{
		$this->template->orders = $this->orders->listOrders(self::ListLimit);
	}


	public function renderShow(string $id): void
	{
		$this->template->name = $id;
		$this->template->content = $this->orders->readOrder($id) ?? $this->error('Objednávka nenalezena.');
	}
}
