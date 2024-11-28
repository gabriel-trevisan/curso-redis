<?php

require_once "src/Models/Post.php";
require_once "src/Models/Tag.php";
require_once "src/Repositories/TagRepository.php";
require_once "src/Repositories/PostRepository.php";

$tag1 = new Tag("PHP");
$tag2 = new Tag("OOP");
$tag3 = new Tag("Desig Pattern");

$post1 = new Post(1, "Como melhorar seu código PHP", "Aqui vai o conteúdo", [$tag1, $tag2]);
$post2 = new Post(2, "Como melhorar seu código PHP parte 2", "Aqui vai o conteúdo", [$tag1, $tag2]);
$post3 = new Post(3, "Desig Patterns", "Conteúdo XYZ", [$tag3]);

$tagRepo = new TagRepository();
$postRepo = new PostRepository();

// $tagRepo->save($tag1);
// $tagRepo->save($tag2);
$postRepo->save($post1);
$postRepo->save($post2);

$postRepo->update(1, $post3);

// Buscando dados do Redis
// $tags = $tagRepo->getAll();
$posts1 = $postRepo->getAll($post1);
$posts2 = $postRepo->getAll($post2);

print_r($posts1);
print_r($posts2);

// foreach ($tags as $tag) {
//     echo $tag->getName() . PHP_EOL;
// }

// foreach ($posts as $post) {
//     echo $post->getTitle() . PHP_EOL;
// }