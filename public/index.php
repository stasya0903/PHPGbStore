<?php
use App\services\Autoload;
use App\services\DB;
use App\modules\Good;
use App\modules\User;
use App\modules\Order;
use App\modules\Feedback;


include dirname(__DIR__) . '/services/Autoload.php';
spl_autoload_register([new Autoload(), 'loadClass']);



$good = new Good();
$good->id = 11;
$good->name_product = "name2";
$good->img_dir = "image24";
$good->description_short = "blalbalalbbalabl";
$good->price_product = 250 ;



