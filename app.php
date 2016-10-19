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

/**
 * @SWG\Swagger(
 *     basePath="/v1",
 *     schemes={"http"},
 *     @SWG\Info(
 *         version="1.0",
 *         title="ConfHub API",
 *     )
 * )
 */
$app = new Slim\App($container);

$app->group('/v1', function () {

    /**
     * @SWG\Get(
     *     path="/conf",
     *     @SWG\Response(response="200", description="Get Response")
     * )
     */
    $this->get('/conf', function (Request $request, Response $response) {
        $conf = Confs::all();
        $json = $conf->toJson();

        // Setting header
        $response = $response->withHeader('Content-type', 'application/json');

        // Setting body
        $body = $response->getBody();
        $body->write($json);

        return $response;
    });

    /**
     * @SWG\Get(
     *     path="/api",
     *     @SWG\Response(response="200", description="Swagger JSON")
     * )
     */
    $this->get('/api', function(Request $request, Response $response) {
        // Use zircote/swagger-php function
        $swagger = \Swagger\scan(__DIR__, [
            'exclude' => [
                'vendor',
            ],
        ]);

        // Setting header
        $response = $response->withHeader('Content-type', 'application/json');

        // Setting body
        $body = $response->getBody();
        $body->write((string) $swagger);

        return $response;
    });
});

return $app;
