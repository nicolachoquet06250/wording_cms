<?php


namespace App\Application\Actions\Controllers\Root;


use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Illuminate\View\Factory;

class RootAction extends Action {
    protected function action(): Response {
        /** @var Factory $template */
        $template = $this->request->getAttribute('template')->view();
        $view = $template->make('index');
        $menu_items = [
            [
                'title' => 'Home',
                'href' => '/',
                'selected' => true
            ]
        ];
        if($this->login->check()) {
            $menu_items[] = [
                'title' => 'Mes projets',
                'href' => '/projects'
            ];
            $menu_items[] = [
                'title' => 'Mon compte',
                'href' => '/me'
            ];
            $menu_items[] = [
                'title' => 'Déconnection',
                'href' => 'javascript:observers.init_menu(observers.DECONNECTION)'
            ];
        } else {
            $menu_items[] = [
                'title' => 'Inscription',
                'href' => '/signup'
            ];
            $menu_items[] = [
                'title' => 'Connection',
                'href' => '/login'
            ];
        }
        $view->with('menu_items', $menu_items);
        $view->with('route_user_api', $this->router()->fullUrlFor($this->uri(), 'user_api', ['id' => '1']));
        $this->response->getBody()->write($view->render());
        return $this->response;
    }
}