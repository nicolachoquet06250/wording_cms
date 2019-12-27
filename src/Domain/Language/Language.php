<?php


namespace App\Domain\Language;

use App\Domain\Page\Page;
use JsonSerializable;

class Language implements JsonSerializable {
    private ?int $id = null;
    private string $code;
    private int $project_id;
    private string $name;
    /**
     * @var Page[] $pages
     */
    private array $pages = [];

    public function __construct(?int $id, string $code, int $project_id, string $name, array $pages) {
        $this->id = $id;
        $this->code = $code;
        $this->project_id = $project_id;
        $this->name = $name;
        $this->pages = $pages;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode(): string {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getProjectId(): int {
        return $this->project_id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return Page[]
     */
    public function getPages(): array {
        return $this->pages;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->getId(),
            'code' => $this->getCode(),
            'project_id' => $this->getProjectId(),
            'name' => $this->getName(),
            'pages' => $this->getPages()
        ];
    }
}