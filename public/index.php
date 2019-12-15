<?php

use App\services\Autoload;
use App\services\DB;
use App\modules\Good;
use App\modules\User;
use App\modules\Order;
use App\modules\Feedback;


require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = new \App\services\Request();
$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();

$ControllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

if (class_exists($ControllerClass)) {
    $controller = new $ControllerClass(new \App\services\renders\TwigRender());
    echo $controller->run($actionName);
}






