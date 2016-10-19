<?php
declare(strict_types=1);

use Illuminate\Database\Capsule\Manager as Capsule;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use ConfHub\Confs;

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$setting = [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => getenv('DB_ADAPTER'),
            'host' => getenv('DB_HOST'),
            'port' => getenv('DB_PORT'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
    ]
];

$container = new Slim\Container($setting);
$container['settings']['displayErrorDetails'] = true;

$capsule = new Capsule();
$capsule->addConnection($setting['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$app = new Slim\App($container);

$app->get('/conf', function (Request $request, Response $response) {
    $conf = Confs::all();
    $json = $conf->toJson();

    // Setting header
    $response = $response->withHeader('Content-type', 'application/json');

    // Setting body
    $body = $response->getBody();
    $body->write($json);

    return $response;
});

$app->get('/', function (Request $request, Response $response) {
    $body = $response->getBody();
    $body->write('Hello World');

    return $response;
});

return $app;
