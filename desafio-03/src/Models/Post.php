<?php 

class Post 
{
    private int $id;
    private string $title;
    private string $content;
    private array $tags;

    public function __construct(
        $id,
        $title,
        $content,
        $tags
    )
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->tags = $tags;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string 
    {
        return $this->title;
    }

    public function getContent(): string 
    {
        return $this->content;
    }

    public function getTags(): array
    {
        return $this->tags;
    }
}