<?php


namespace App\Application;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


class PersoEnvVars {
    public static function init() {
        $envfile = '/etc/environment';
        $envfile_content = trim(file_get_contents($envfile));
        $envfile_content_parsed = str_replace(["\r", "\n\r", "\r\n"], "\n", $envfile_content);
        $envfile_content_parsed = explode("\n", $envfile_content_parsed);
        foreach ($envfile_content_parsed as $key => $line) {
            $envfile_content_parsed[$key] = str_replace("'", "", $line);
        }

        foreach ($envfile_content_parsed as $key => $line) {
            putenv($line);
        }
        //in /etc/environment write at the end:
        //      DATABASE='{"app_name": {"driver": "database_motor", "database": "dbname", "host": "localhost", "port": 3306, "username": "db_username", "password": "db_password"}}'

    }
}