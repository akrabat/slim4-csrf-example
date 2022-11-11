<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

return static function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        Guard::class => fn () => new Guard(AppFactory::determineResponseFactory()),
        Twig::class => fn () => Twig::create(__DIR__ . '/../templates', ['cache' => __DIR__ . '/../var/cache']),
    ]);
};
