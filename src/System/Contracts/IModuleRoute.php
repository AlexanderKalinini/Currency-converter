<?php

namespace System\Contracts;

interface IModuleRoute
{
	public function registerRoutes(IRouter $router): void;
}
