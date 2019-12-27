<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Application\Middleware\TemplateMiddleware;
use Slim\App;
use Slim\Psr7\Factory\UriFactory;
use Slim\Routing\RouteParser;

return function (App $app) {
    $app->add(TemplateMiddleware::class);
    $app->add(function(Request $request, RequestHandler $handler) use($app) {
        $request = $request->withAttribute('router', new RouteParser($app->getRouteCollector()));
        $urlFactory = new UriFactory();
        $domain = $_SERVER['SERVER_NAME'];
        $request = $request->withAttribute('uri', $urlFactory->createUri("//{$domain}"));
        return $handler->handle($request);
    });
};
