<?php

require_once __DIR__ . '/../Database/RedisConnection.php';

class PostRepository
{
    private $redis;

    public function __construct()
    {
        $this->redis = (new RedisConnection())->getClient();
    }

    public function save(Post $post): void
    {
        $this->redis->hmset('post:' . $post->getId(), [
            'title' => $post->getTitle(),
            'content' => $post->getContent()
        ]);

        foreach ($post->getTags() as $tag) {
            $this->redis->sadd('tags:' . $post->getId(), $tag->getName());
        }

        $this->redis->lpush("posts", $post->getId());
    }

    public function update(int $id, Post $post): void
    {
        $title = $post->getTitle();
        $content = $post->getContent();
        $tags = $post->getTags();

        if (!empty($title)) {
            $this->redis->hset('post:' . $id, 'title', $title);
        }

        if (!empty($content)) {
            $this->redis->hset('post:' . $id, 'content', $content);
        }

        if (!empty($tags)) {
            //Remover tags antigas
            $oldTags = $this->redis->smembers('tags:' . $id);

            foreach ($oldTags as $oldTag) {
                $this->redis->srem('tags:' . $id, $oldTag);
            }

            //Adicionar tags novas
            foreach ($tags as $tag) {
                $this->redis->sadd('tags:' . $id, $tag->getName());
            }
        }
    }

    public function getAll(Post $post): array
    {
        return $this->redis->hgetall('post:' . $post->getId());
    }

    public function delete(Post $post)
    {
        $id = $post->getId();

        $this->redis->lrem('posts', 0, $id);

        $tags = $this->redis->smembers('tags:'. $id);
        foreach ($tags as $tag) {
            $this->redis->srem('tags:' . $id, $tag);
        }

        $this->redis->del('post:'. $id);
    }

    public function list()
    {
        $ids = $this->redis->lrange('posts', 0, -1);
        $posts = [];

        foreach ($ids as $id) {
            array_push($posts, $this->redis->hgetall('post:' . $id));
        }

        return $posts;
    }
}
