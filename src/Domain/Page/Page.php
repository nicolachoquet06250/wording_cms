<?php


namespace App\Domain\Page;

use JsonSerializable;

class Page implements JsonSerializable {
    private ?int $id = null;
    private string $name;
    private int $language_id;
    /**
     * @var mixed[] $properties
     */
    private array $properties = [];

    public function __construct(?int $id, string $name, int $language_id, array $properties) {
        $this->id = $id;
        $this->name = $name;
        $this->language_id = $language_id;
        $this->properties = $properties;
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
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLanguageId(): int {
        return $this->language_id;
    }

    /**
     * @return mixed[]
     */
    public function getProperties(): array {
        return $this->properties;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'language_id' => $this->getLanguageId(),
            'properties' => $this->getProperties(),
        ];
    }
}