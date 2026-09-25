<?php

declare(strict_types=1);

namespace App\Core;

use Nette\Application\Routers\RouteList;
use Nette\StaticClass;


final class RouterFactory
{
	use StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

		$router->withModule('Admin')
			->addRoute('edit/index.php', 'Posts:default', oneWay: true)
			->addRoute('edit[/<presenter>[/<action>[/<id>]]]', 'Posts:default');

		$router->withModule('Front')
			->addRoute('index.php', 'Home:default', oneWay: true)
			->addRoute('zakoupit/index.php', 'Order:default', oneWay: true)
			->addRoute('zakoupit/thankyou.php', 'Order:thankyou', oneWay: true)
			->addRoute('zakoupit/dekujeme', 'Order:thankyou')
			->addRoute('zakoupit', 'Order:default')
			->addRoute('', 'Home:default');

		return $router;
	}
}
