<?php

require_once "src/Models/Post.php";
require_once "src/Models/Tag.php";
require_once "src/Repositories/TagRepository.php";
require_once "src/Repositories/PostRepository.php";

$tag1 = new Tag("PHP");
$tag2 = new Tag("OOP");
$tag3 = new Tag("Design Pattern");
$tag4 = new Tag("KanBan");
$tag5 = new Tag("Scrum");

$post1 = new Post(1, "Como melhorar seu código PHP", "Aqui vai o conteúdo", [$tag1, $tag2]);
$post2 = new Post(2, "Como melhorar seu código PHP parte 2", "Aqui vai o conteúdo", [$tag1, $tag2]);
$post3 = new Post(3, "Design Patterns", "Conteúdo XYZ", [$tag3]);
$post4 = new Post(4, "Projetos Ágeis", "Conteúdo para projetos ágeis", [$tag4, $tag5]);

$tagRepo = new TagRepository();
$postRepo = new PostRepository();

$postRepo->save($post1);
$postRepo->save($post2);
$postRepo->save($post4);

$postRepo->update(1, $post3);
$postRepo->delete($post2);

$posts1 = $postRepo->getAll($post1);
$posts2 = $postRepo->getAll($post2);

print_r($postRepo->list());