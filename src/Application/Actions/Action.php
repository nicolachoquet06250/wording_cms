<?php
declare(strict_types=1);

namespace App\Application\Actions;

use App\Application\Interfaces\Login;
use App\Application\Interfaces\Session;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteParser;

abstract class Action {
    protected LoggerInterface $logger;
    protected Request $request;
    protected Response $response;
	protected Session $session;
	protected Login $login;

    protected array $args;

    public function __construct(LoggerInterface $logger, Session $session, Login $login) {
        $this->logger = $logger;
        $this->session = $session;
        $this->login = $login->sessionIs($this->session);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws HttpBadRequestException
     * @throws HttpNotFoundException
     */
    public function __invoke(Request $request, Response $response, array $args): Response {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (DomainRecordNotFoundException $e) {
            throw new HttpNotFoundException($this->request, $e->getMessage());
        }
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @return array|object
     * @throws HttpBadRequestException
     */
    protected function getFormData() {
        $input = json_decode(file_get_contents('php://input'));

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new HttpBadRequestException($this->request, 'Malformed JSON input.');
        }

        return $input;
    }

    /**
     * @param  string $name
     * @return mixed
     * @throws HttpBadRequestException
     */
    protected function resolveArg(string $name) {
        if (!isset($this->args[$name])) {
            throw new HttpBadRequestException($this->request, "Could not resolve argument `{$name}`.");
        }

        return $this->args[$name];
    }

    /**
     * @param  array|object|null $data
     * @return Response
     */
    protected function respondWithData($data = null): Response {
        $payload = new ActionPayload(200, $data);
        return $this->respond($payload);
    }

    protected function respond(ActionPayload $payload): Response {
        $json = json_encode($payload, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);
        return $this->response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    protected function get(string $id) {
        return $this->request->getAttribute($id);
    }

    protected function router(): RouteParser {
        return $this->get('router');
    }

    protected function uri(): UriInterface {
        return $this->get('uri');
    }
}
