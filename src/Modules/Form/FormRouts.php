<?php

namespace Modules\Form;

use System\Contracts\IModuleRoute;
use System\Contracts\IRouter;
use Modules\Form\Controllers\FormController;

class FormRouts implements IModuleRoute
{
	public function registerRoutes(IRouter $router): void
	{
		$router->addRoute("/^$/", FormController::class);
		$router->addRoute("/login$/", FormController::class, 'login');
		$router->addRoute("/signup$/", FormController::class, 'signup');
	}
}
