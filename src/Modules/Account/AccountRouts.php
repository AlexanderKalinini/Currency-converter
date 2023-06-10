<?php

namespace Modules\Account;

use System\Contracts\IModuleRoute;
use System\Contracts\IRouter;
use Modules\Account\Controllers\AccountController;

class AccountRouts implements IModuleRoute
{
	public function registerRoutes(IRouter $router): void
	{
		$router->addRoute(
			"/convert$/",
			AccountController::class,
			'convert'
		);;
	}
}
