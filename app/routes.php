<?php
declare(strict_types=1);

use App\Application\Actions\Controllers\Root\RootAction;
use App\Application\Actions\Controllers\User\GetMyselfAction;
use App\Application\Actions\Controllers\User\LoginAction;
use App\Application\Actions\Controllers\User\LogoutAction;
use App\Application\Actions\Controllers\User\ListUsersAction;
use App\Application\Actions\Controllers\User\ViewUserAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', RootAction::class);

    $app->get('/me', RootAction::class); // temporary class

    $app->get('/users', ListUsersAction::class);

    $app->group('/user', function(Group $group) {
        $group->get('/me', GetMyselfAction::class);
	    $group->get('/logout', LogoutAction::class);
	    $group->post('/login', LoginAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });
};
