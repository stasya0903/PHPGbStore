<?php
use App\Controllers\Controller;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('main', '/')
        ->controller([Controller::class, 'index'])
    ;

    $routes->add('good', '/articles/{slug}')
        ->controller([BlogController::class, 'show'])
    ;
};