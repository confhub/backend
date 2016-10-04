<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$container = new Slim\Container();
$container['settings']['displayErrorDetails'] = true;

$app = new Slim\App($container);

$app->get('/', function (Request $request, Response $response) {
    $body = $response->getBody();
    $body->write('Hello World');

    return $response;
});

return $app;
