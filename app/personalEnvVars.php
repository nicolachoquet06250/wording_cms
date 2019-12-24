<?php


namespace App\Application;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

function add_env_vars_in_file($envfile) {
    $envfile_content = trim(file_get_contents($envfile));
    $envfile_content_parsed = str_replace(["\r", "\n\r", "\r\n"], "\n", $envfile_content);
    $envfile_content_parsed = explode("\n", $envfile_content_parsed);
    foreach ($envfile_content_parsed as $key => $line) {
        putenv(str_replace(["'", 'export '], "", $line));
    }
}

return function (...$files) {
    foreach ($files as $file) {
        if(file_exists($file)) {
            add_env_vars_in_file($file);
        }
    }
    //in /etc/environment || ~/.bashrc write at the end:
    //      DATABASE='{"app_name": {"driver": "database_motor", "database": "dbname", "host": "localhost", "port": 3306, "username": "db_username", "password": "db_password"}}'
};
