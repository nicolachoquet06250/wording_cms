<?php


namespace App\Domain\Project;

use App\Domain\Language\Language;
use JsonSerializable;

class Project implements JsonSerializable {
    private ?int $id = null;
    private string $name;
    /**
     * @var Language[] $languages
     */
    private array $languages = [];
    private string $default_language = 'fr';
    private string $default_language_name = 'Français';

    public function __construct(?int $id, string $name, array $languages = [], string $default_language = 'fr', $default_language_name = 'Français') {
        $this->id = $id;
        $this->name = $name;
        $this->languages = $languages;
        $this->default_language = $default_language;
        $this->default_language_name = $default_language_name;
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
     * @return Language[]
     */
    public function getLanguages(): array {
        return $this->languages;
    }

    /**
     * @return string
     */
    public function getDefaultLanguage(): string {
        return $this->default_language;
    }

    /**
     * @return string
     */
    public function getDefaultLanguageName(): string {
        return $this->default_language_name;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'languages' => $this->getLanguages(),
            'default_language' => $this->getDefaultLanguage()
        ];
    }
}