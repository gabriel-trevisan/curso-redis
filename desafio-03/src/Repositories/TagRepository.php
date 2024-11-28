<?php

require_once __DIR__ . '/../Database/RedisConnection.php';

class TagRepository
{
    private $redis;

    public function __construct()
    {
        $this->redis = (new RedisConnection())->getClient();
    }

    public function save(Tag $tag): void
    {
        $this->redis->set('tag:' . $tag->getName(), serialize($tag));
    }

    public function get(string $tagName): ?Tag
    {
        $data = $this->redis->get('tag:' . $tagName);
        return $data ? unserialize($data) : null;
    }

    public function getAll(): array
    {
        // A partir de uma abordagem mais simples, você pode armazenar tags em um conjunto Redis.
        $tagNames = $this->redis->keys('tag:*');
        $tags = [];

        foreach ($tagNames as $tagName) {
            $tags[] = $this->get(str_replace('tag:', '', $tagName)); // Obtendo cada tag pelo nome
        }

        return $tags;
    }
}
