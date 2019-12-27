<?php
declare(strict_types=1);


use App\Application\Actions\Controllers\Account\AccountAction as Account;
use App\Application\Actions\Controllers\Project\MyProjectsAction as MyProjects;
use App\Application\Actions\Controllers\Root\RootAction as Root;
use App\Application\Actions\Controllers\Login\LoginAction as Login;
use App\Application\Actions\Controllers\Signup\SignupAction as Signup;
use App\Application\Actions\Controllers\User\GetMyselfAction as GetMyselfAPI;
use App\Application\Actions\Controllers\User\LoginAction as LoginAPI;
use App\Application\Actions\Controllers\User\SignupAction as SignupAPI;
use App\Application\Actions\Controllers\User\LogoutAction as LogoutAPI;
use App\Application\Actions\Controllers\User\ListUsersAction as ListUsersAPI;
use App\Application\Actions\Controllers\User\ViewUserAction as ViewUserAPI;
use App\Application\Actions\Controllers\Project\AddProjectAction as AddProjectAPI;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', Root::class)->setName('home');
    $app->get('/login', Login::class)->setName('login');
    $app->get('/signup', Signup::class)->setName('signup');
    $app->get('/me', Account::class)->setName('account');

    $app->group('/user', function(Group $group) {
        $group->get('/{id:'.PARAM_INT.'}', ViewUserAPI::class)->setName('user_api');
        $group->get('s', ListUsersAPI::class)->setName('user_list_api');
        $group->get('/me', GetMyselfAPI::class)->setName('account_api');
        $group->post('/signup', SignupAPI::class)->setName('signup_api');
        $group->post('/login', LoginAPI::class)->setName('login_api');
	    $group->get('/logout', LogoutAPI::class)->setName('logout_api');
    });

    $app->group('/project', function (Group $group) {
        $group->get('/{id:'.PARAM_INT.'}', fn() => null)->setName('project_api');
        $group->get('s', MyProjects::class)->setName('get_projects');
        $group->post('', AddProjectAPI::class)->setName('add_project_api');
    });

    $app->get('/{project:'.PARAM_STR.'}/{lang:'.PARAM_STR.'}/{page:'.PARAM_STR.'}.json', fn() => null)->setName('page_json');
    $app->get('/{project:'.PARAM_STR.'}/{page:'.PARAM_STR.'}.json', fn() => null)->setName('page_json_default_lang');
};
