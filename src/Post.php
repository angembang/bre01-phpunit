<?php

declare(strict_types=1);

class Post
{
    // Propriétés de la classe
    private string $title;
    private string $content;
    private string $slug;
    private bool $private = false;

    // Constructeur de la classe
    public function __construct(string $title, string $content, string $slug, bool $private = false)
    {
        // Vérifications des valeurs fournies
        $this->ensureIsEmptyTitle($title);
        $this->ensureIsEmptyContent($content);
        $this->ensureIsEmptySlug($slug);

        // Initialisation des propriétés
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->private = $private;
    }

    // Méthode statique pour créer une instance de Post
    public static function ensureIsValidPost(string $title, string $content, string $slug): self
    {
        return new self($title, $content, $slug);
    }

    // Méthode privée pour vérifier si le titre est vide
    private function ensureIsEmptyTitle(string $title): void
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Title can't be empty");
        }
    }

    // Méthode privée pour vérifier si le contenu est vide
    private function ensureIsEmptyContent(string $content): void
    {
        if (empty($content)) {
            throw new InvalidArgumentException("Content can't be empty");
        }
    }

    // Méthode privée pour vérifier si le slug est vide et ne contient que des caractères URL valides
    private function ensureIsEmptySlug(string $slug): void
    {
        if (empty($slug) || !preg_match("/^[a-zA-Z0-9\-]+$/", $slug)) {
            throw new InvalidArgumentException("Slug can't be empty and must contain only URL characters");
        }
    }

    // Les getters (méthodes publiques pour récupérer les propriétés du Post)
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getPrivate(): bool
    {
        return $this->private;
    }

    // Les setters (méthodes publiques pour définir les propriétés du Post)
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function setPrivate(bool $private): void
    {
        $this->private = $private;
    }
}