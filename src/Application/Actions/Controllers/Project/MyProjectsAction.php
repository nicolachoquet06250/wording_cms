<?php


namespace App\Application\Actions\Controllers\Project;


use Illuminate\View\Factory;
use Psr\Http\Message\ResponseInterface as Response;

class MyProjectsAction extends ProjectAction {
    protected function action(): Response {
        /** @var Factory $template */
        $template = $this->request->getAttribute('template')->view();
        $view = $template->make('projects');
        $menu_items = [
            [
                'title' => 'Home',
                'href' => '/'
            ],
            [
                'title' => 'Mes projets',
                'href' => '/projects',
                'selected' => true
            ]
        ];
        if($this->login->check()) {
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
        $view->with('isLogged', $this->login->check());
        $view->with('projects', $this->projectRepository->findAll());
        $this->response->getBody()->write($view->render());
        return $this->response;
    }
}