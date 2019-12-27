<?php


namespace App\Application\Actions\Controllers\Account;


use App\Application\Actions\Action;
use Illuminate\View\Factory;
use Psr\Http\Message\ResponseInterface as Response;

class AccountAction extends Action {

    protected function action(): Response {
        /** @var Factory $template */
        $template = $this->request->getAttribute('template')->view();
        $view = $template->make('account');
        $menu_items = [
            [
                'title' => 'Home',
                'href' => '/'
            ],
            [
                'title' => 'Mes projets',
                'href' => '/projects'
            ],
            [
                'title' => 'Mon compte',
                'href' => '/me',
                'selected' => true
            ],
        ];
        if($this->login->check()) {
            $menu_items[] = [
                'title' => 'Déconnection',
                'href' => 'javascript:observers.init_menu(observers.DECONNECTION)'
            ];
        }
        $view->with('menu_items', $menu_items);
        $view->with('user', $this->login->getUser());
        $this->response->getBody()->write($view->render());
        return $this->response;
    }
}