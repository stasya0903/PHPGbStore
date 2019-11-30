<?php
use App\services\Autoload;
use App\services\DB;
use App\modules\Good;
use App\modules\User;
use App\modules\Order;
use App\modules\Feedback;


include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);

$db = new DB();


$good = new Good($db);

var_dump($good->getAll());
var_dump($good->getOne(2));

$user = new User($db);
var_dump($user->getAll());
var_dump($user->getOne(15));

$order = new Order($db);

var_dump($order->getAll());
var_dump($order->getOne(39));

$feedback = new Feedback($db);

var_dump($feedback->getAll());
var_dump($feedback->getOne(1));
