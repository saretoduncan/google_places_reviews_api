<?php declare(strict_types=1);

use App\Controllers\GoogleApiController;
use App\Services\GoogleApiService;
use DI\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

$container = new Container();
$container->set('logger', function () {
    if (!file_exists(__DIR__ . '/../logFile.log')) {
        touch(__DIR__ . '/../logFile.log');
    }
    $logger = new Logger('my_logger');
    $logger->pushHandler(new StreamHandler(__DIR__ . '/../logFile.log', Logger::ERROR));
    return $logger;
});
$container->set(GoogleApiService::class, function (ContainerInterface $containerInterface) {
    return new GoogleApiService($containerInterface->get('logger'));
});
$container->set(GoogleApiController::class, function (ContainerInterface $containerInterface) {
    return new GoogleApiController($containerInterface->get(GoogleApiService::class));
});
