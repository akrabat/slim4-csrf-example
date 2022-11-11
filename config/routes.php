<?php

declare(strict_types=1);

use App\Handler\HomePageHandler;
use Slim\App;

return static function (App $app) {
    $app->map(['GET', 'POST'], '/', HomePageHandler::class)->setName('home');
};
