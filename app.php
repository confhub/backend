<?php
declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$setting = [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'default',
            'username' => 'root',
            'password' => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ]
];

$container = new Slim\Container($setting);
$container['settings']['displayErrorDetails'] = true;
$container['db'] = function ($container) {
    $capsule = new Capsule();
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

$app = new Slim\App($container);

$app->get('/', function (Request $request, Response $response) {
    $body = $response->getBody();
    $body->write('Hello World');

    return $response;
});

return $app;
