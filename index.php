<?php
	use DI\Container;
	use Psr\Http\Message\ResponseInterface as Response;
	use Psr\Http\Message\ServerRequestInterface as Request;
	use Slim\Factory\AppFactory;

	require __DIR__ . '/vendor/autoload.php';
	require_once __DIR__.'/src/autoload.php';

	echo '<pre>';

	$container = new Container();
	$container->set('cookies', function() {
		return new \services\Cookies();
	});
	AppFactory::setContainer($container);

	$app = AppFactory::create();

	$app->addRoutingMiddleware();

	$app->get('/hello/{name}', function ($request, $response, $args) use($app) {
		$response->getBody()->write("Hello ".$args['name']."<br/>");

		$routeParser = $app->getRouteCollector()->getRouteParser();
		$response->getBody()->write($routeParser->urlFor('hello', ['name' => 'Nicolas']));

		$this->get('cookies')->set('name');

		return $response;
	})->setName('hello');

        $app->get('/', function (Request $req, Response $res, $args) {
		$res->getBody()->write("Hello world!");
		return $res;
	});

	$app->run();
