<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\Factory\AppFactory;
use Slim\Handlers\Strategies\RequestHandler;

require __DIR__ . '/../vendor/autoload.php';

// Set up dependencies
$containerBuilder = new ContainerBuilder();
if($_ENV['DI_COMPLICATION_PATH'] ?? '') {
    $containerBuilder->enableCompilation($_ENV['DI_COMPLICATION_PATH']);
}
(require __DIR__ . '/../config/dependencies.php')($containerBuilder);

// Create app
$container = $containerBuilder->build();
AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();

// Assign matched route arguments to Request attributes for PSR-15 handlers
$app->getRouteCollector()->setDefaultInvocationStrategy(new RequestHandler(true));

// Register middleware
(require __DIR__ . '/../config/middleware.php')($app);

// Register routes
(require __DIR__ . '/../config/routes.php')($app);

session_start();
// Run app
$app->run();
