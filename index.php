<?php

include_once 'init.php';
include_once 'vendor/autoload.php';


use System\ModulesDispatcher;
use System\Router;
use Modules\Form\FormRouts;
use Modules\Account\AccountRouts;




const BASE_URL = '/oop/parser/';

$modulesDispatcher = new ModulesDispatcher();
$modulesDispatcher->add(new FormRouts());
$modulesDispatcher->add(new AccountRouts());
$router = new Router(BASE_URL);
$modulesDispatcher->registerRoutes($router);

$uri = $_SERVER['REQUEST_URI'];



$controllerAndMethod = $router->resolvePath($uri);

$controller = $controllerAndMethod['controller'];
$method = $controllerAndMethod['method'];


$controller->$method();
$html = $controller->render();
echo $html;