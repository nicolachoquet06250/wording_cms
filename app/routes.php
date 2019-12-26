<?php
declare(strict_types=1);

use App\Application\Actions\Controllers\Account\AccountAction as Account;
use App\Application\Actions\Controllers\Root\RootAction as Root;
use App\Application\Actions\Controllers\Login\LoginAction as Login;
use App\Application\Actions\Controllers\Signup\SignupAction as Signup;
use App\Application\Actions\Controllers\User\GetMyselfAction as GetMyselfAPI;
use App\Application\Actions\Controllers\User\LoginAction as LoginAPI;
use App\Application\Actions\Controllers\User\SignupAction as SignupAPI;
use App\Application\Actions\Controllers\User\LogoutAction as LogoutAPI;
use App\Application\Actions\Controllers\User\ListUsersAction as ListUsersAPI;
use App\Application\Actions\Controllers\User\ViewUserAction as ViewUserAPI;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', Root::class);
    $app->get('/login', Login::class);
    $app->get('/signup', Signup::class);
    $app->get('/me', Account::class);

    $app->get('/users', ListUsersAPI::class);
    $app->group('/user', function(Group $group) {
        $group->get('/me', GetMyselfAPI::class);
	    $group->get('/logout', LogoutAPI::class);
	    $group->post('/login', LoginAPI::class);
	    $group->post('/signup', SignupAPI::class);
        $group->get('/{id}', ViewUserAPI::class);
    });
};
