<?php
declare(strict_types=1);

use App\Application\Middleware\TemplateMiddleware;
use Slim\App;

return function (App $app) {
    $app->add(TemplateMiddleware::class);
};
