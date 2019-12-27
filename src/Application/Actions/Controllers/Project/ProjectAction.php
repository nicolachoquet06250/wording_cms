<?php


namespace App\Application\Actions\Controllers\Project;


use App\Application\Actions\Action;
use App\Application\Interfaces\Login;
use App\Application\Interfaces\Session;
use App\Domain\Project\ProjectRepository;
use Psr\Log\LoggerInterface;

abstract class ProjectAction extends Action {
    /**
     * @var ProjectRepository $projectRepository
     */
    protected ProjectRepository $projectRepository;

    public function __construct(LoggerInterface $logger, ProjectRepository $projectRepository, Session $session, Login $login) {
        parent::__construct($logger, $session, $login);
        $this->projectRepository = $projectRepository;
    }
}