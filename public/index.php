<?php

use App\exceptions\AddressNotFoundException;
use App\services\Autoload;
use App\services\DB;
use App\modules\Good;
use App\modules\User;
use App\modules\Order;
use App\modules\Feedback;
use App\services\renders\TwigRender;

session_start();
require_once dirname(__DIR__) . '/vendor/autoload.php';

$request = new \App\services\Request();
$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();

new \Twig\Loader\FilesystemLoader();

$ControllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller';

try {
    if(!class_exists($ControllerClass)){
        throw new AddressNotFoundException();
    }
    $controller = new $ControllerClass(new TwigRender(), $request);
    echo $controller->run($actionName);

}catch ( AddressNotFoundException $e){
   echo  ( new TwigRender())->render('error');

}







