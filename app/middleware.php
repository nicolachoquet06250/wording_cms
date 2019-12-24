<?php
declare(strict_types=1);

use App\Application\Middleware\PersoEnvVars;
use App\Application\Middleware\SessionMiddleware;
use App\Application\Middleware\TemplateMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(SessionMiddleware::class);
    $app->add(TemplateMiddleware::class);
};
