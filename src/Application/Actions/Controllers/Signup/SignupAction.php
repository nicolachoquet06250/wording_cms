<?php


namespace App\Application\Actions\Controllers\Signup;


use App\Application\Actions\Action;
use Illuminate\View\Factory;
use Psr\Http\Message\ResponseInterface as Response;

class SignupAction extends Action {
    protected function action(): Response {
        /** @var Factory $template */
        $template = $this->request->getAttribute('template')->view();
        $view = $template->make('signup');
        $menu_items = [
            [
                'title' => 'Home',
                'href' => '/'
            ],
            [
                'title' => 'Inscription',
                'href' => '/signup',
                'selected' => true
            ],
            [
                'title' => 'Connection',
                'href' => '/login'
            ]
        ];

        $view->with('menu_items', $menu_items);
        $view->with('isLogged', $this->login->check());
        $this->response->getBody()->write($view->render());
        return $this->response;
    }
}