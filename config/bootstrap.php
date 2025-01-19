<?php declare(strict_types=1);

use App\Middlewares\ResponseMiddleware;
use DI\Bridge\Slim\Bridge;
use Dotenv\Dotenv;
use Selective\BasePath\BasePathMiddleware;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/container.php';
$dotEnv = Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();
$app = Bridge::create($container);

$app->addRoutingMiddleware();
$app->add(new BasePathMiddleware($app));
$app->addBodyParsingMiddleware();
$error_middleware = $app->addErrorMiddleware(true, true, true);
$error_handler = $error_middleware->getDefaultErrorHandler();
$error_handler->forceContentType('application/json');
$app->add(ResponseMiddleware::class);
require __DIR__ . '/../config/routes.php';

return $app;
