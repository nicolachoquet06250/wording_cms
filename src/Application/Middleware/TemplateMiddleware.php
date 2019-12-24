<?php


namespace App\Application\Middleware;

use Philo\Blade\Blade;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class TemplateMiddleware implements MiddleWare {

    public function process(Request $request, RequestHandler $handler): Response {
        return $handler->handle(
            $request->withAttribute(
                'template',
                new Blade(__DIR__.'/../../Views', __DIR__.'/../../../var/cache/views')
            )
        );
    }
}