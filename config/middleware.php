<?php

declare(strict_types=1);

use Slim\App;
use Slim\Csrf\Guard;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

return static function (App $app) {
    $app->addRoutingMiddleware();
    $app->add(TwigMiddleware::createFromContainer($app, Twig::class));
    $app->add(Guard::class);
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware(true, true, true);
};
