<?php


namespace App\Domain\Project;


use App\Domain\User\UserNotFoundException;
use PDO;

interface ProjectRepository {
    public function __construct(PDO $db);

    /**
     * @return Project[]
     */
    public function findAll();

    /**
     * @param int $id
     *
     * @return Project
     * @throws UserNotFoundException
     */
    public function findById(int $id): Project;

    /**
     * @param string $name
     *
     * @return Project
     * @throws UserNotFoundException
     */
    public function findByName(string $name): Project;

    /**
     * @param string $languageCode
     *
     * @return Project[]
     * @throws UserNotFoundException
     */
    public function findByLanguageCode(string $languageCode): array;

    /**
     * @param Project $project
     *
     * @return int|null
     */
    public function add(Project $project): ?int;
}