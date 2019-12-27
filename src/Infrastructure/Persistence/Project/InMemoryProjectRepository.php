<?php


namespace App\Infrastructure\Persistence\Project;


use App\Domain\Language\Language;
use App\Domain\Page\Page;
use App\Domain\Project\Project;
use App\Domain\Project\ProjectNotFoundException;
use App\Domain\Project\ProjectRepository;
use PDO;

class InMemoryProjectRepository implements ProjectRepository {
    /** @var Project[] $projects */
    private array $projects = [];
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->rebuild();
    }

    private function rebuild() {
        $project_query = $this->db->query('SELECT `id`, `name`, `default_language`, `default_language_name` FROM `project`');
        foreach ($project_query->fetchAll(PDO::FETCH_ASSOC) as $project) {
            $languages_query = $this->db->query("SELECT `id`, `code`, `project_id`, `name` FROM `language` WHERE `project_id`={$project['id']}");
            $languages = [];
            foreach ($languages_query->fetchAll(PDO::FETCH_ASSOC) as $language) {
                $page_query = $this->db->query("SELECT `id`, `name`, `language_id` FROM `page` WHERE `language_id`={$language['id']}");
                $pages = [];
                foreach ($page_query->fetchAll(PDO::FETCH_ASSOC) as $page) {
                    $properties_query = $this->db->query("SELECT `id`, `key`, `value` FROM `property` WHERE `page_id`={$page['id']}");
                    $properties = [];
                    foreach ($properties_query->fetchAll(PDO::FETCH_ASSOC) as $property) {
                        $properties[(int) $property['id']] = [
                            'key' => $property['key'],
                            'value' => $property['value'],
                        ];
                    }

                    $pages[(int) $page['id']] = new Page((int) $page['id'], $page['name'], (int) $page['language_id'], $properties);
                }

                $languages[(int) $language['id']] = new Language((int) $language['id'], $language['code'], (int) $language['project_id'], $language['name'], $pages);
            }

            $this->projects[(int) $project['id']] = new Project((int) $project['id'], $project['name'], $languages, $project['default_language'], $project['default_language_name']);
        }
    }

    /**
     * @return Project[]
     */
    public function findAll(): array {
        return $this->projects;
    }

    /**
     * @param int $id
     *
     * @return Project
     * @throws ProjectNotFoundException
     */
    public function findById(int $id): Project {
        if (!isset($this->projects[$id])) {
            $this->rebuild();
            if(!isset($this->projects[$id])) {
                throw new ProjectNotFoundException();
            }
        }
        return $this->projects[$id];
    }

    /**
     * @param string $name
     *
     * @return Project
     * @throws ProjectNotFoundException
     */
    public function findByName(string $name): Project {
        foreach ($this->projects as $project) {
            if($project->getName() === $name) {
                return $project;
            }
        }
        throw new ProjectNotFoundException();
    }

    /**
     * @param string $languageCode
     *
     * @return Project[]
     * @throws ProjectNotFoundException
     */
    public function findByLanguageCode(string $languageCode): array {
        $projects = [];
        foreach ($this->projects as $project) {
            foreach ($project->getLanguages() as $language) {
                if($language->getCode() === $languageCode) {
                    $projects[$project->getId()] = $project;
                    break;
                }
            }
        }
        return $projects;
    }

    /**
     * @param Project $project
     *
     * @return int|null
     */
    public function add(Project $project): ?int {
        $this->db->prepare("INSERT INTO `project` (name, default_language, default_language_name) 
                VALUES (
                    '{$project->getName()}', 
                    '{$project->getDefaultLanguage()}', 
                    '{$project->getDefaultLanguageName()}'
                )")->execute();
        $project_id = (int) $this->db->lastInsertId() ? (int) $this->db->lastInsertId() : null;

        if(!is_null($project_id)) {
            $this->db->prepare("INSERT INTO `language` (code, project_id, name) 
                VALUES (
                    '{$project->getDefaultLanguage()}', 
                    {$project_id}, 
                    '{$project->getDefaultLanguageName()}'
                )")->execute();
            $language_id = (int) $this->db->lastInsertId() ? (int) $this->db->lastInsertId() : null;

            if(is_null($language_id)) {
                $this->db->prepare("DELETE FROM `project` WHERE `id`={$project_id}")->execute();
            } else {
                $this->db->prepare("INSERT INTO `page` (name, language_id) VALUES ('default', {$language_id})")->execute();
                $page_id = (int) $this->db->lastInsertId() ? (int) $this->db->lastInsertId() : null;

                if(is_null($page_id)) {
                    $this->db->prepare("DELETE FROM `language` WHERE `id`={$language_id}")->execute();
                    $this->db->prepare("DELETE FROM `project` WHERE `id`={$project_id}")->execute();
                } else {
                    $this->rebuild();
                    return $project_id;
                }
            }
        }
        return null;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function deleteFromId(int $id): bool {
        $query = $this->db->query("SELECT `id` FROM `language` WHERE `project_id`={$id}");
        foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $line) {
            $query = $this->db->query("SELECT `id` FROM `page` WHERE `language_id`={$line['id']}");
            foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $line) {
                $this->db->prepare("DELETE FROM `property` WHERE `page_id`={$line['id']}")->execute();
            }
            $this->db->prepare("DELETE FROM `page` WHERE `language_id`={$line['id']}")->execute();
        }
        $this->db->prepare("DELETE FROM `language` WHERE `project_id`={$id}")->execute();
        $this->db->prepare("DELETE FROM `project` WHERE `id`={$id}")->execute();

        $this->rebuild();

        if(isset($this->projects[$id])) {
            return false;
        }
        return true;
    }
}