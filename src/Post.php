<?php

declare(strict_types=1);

class Post
{
    private string $title;
    private string $content;
    private string $slug;
    private bool $private = false;
    
    
    public function __construct(string $title, string $content, string $slug, bool $private = false)
    {
        $this->ensureIsEmptyTitle($title);
        $this->ensureIsEmptyContent($content);
        $this->ensureIsEmptySlug($slug);
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->private = $private;
    }
    
    
    
    
    
    public static function ensureIsValidPost(string $title, string $content, string $slug): self
    {
        return new self($title, $content, $slug);
    }
    private function ensureIsEmptyTitle(string $title): void
    {
    if (empty($title))
    {
        throw new InvalidArgumentException("Title can't be empty");
    }
    }
    private function ensureIsEmptyContent(string $content): void
    {
        if(empty($content))
        {
            throw new InvalidArgumentException("Content can't be empty");
        }
    }
    private function ensureIsEmptySlug(string $slug): void
    {
         if(empty($slug) || 
        !preg_match("/^[a-zA-Z0-9\-]+$/", $slug))
        {
            throw new InvalidArgumentException
            ("Slug can't be empty and must contain only URL characters");
        }
    }
    
    
    
    
    
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