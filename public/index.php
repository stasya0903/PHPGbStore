<?php
use App\services\Autoload;
use App\services\DB;
use App\modules\Good;
use App\modules\User;
use App\modules\Order;
use App\modules\Feedback;


include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);

$controllerName = "user";
$actionName = '';

if (!(empty($_GET['c']))){
    $controllerName = $_GET['c'];
}

if (!empty($_GET['a'])){
    $actionName = $_GET['a'];
}


$ControllerClass = 'App\\controllers\\' . ucfirst($controllerName) . 'Controller' ;

if (class_exists($ControllerClass)){
    $controller = new $ControllerClass;
    echo $controller -> run($actionName);
}






