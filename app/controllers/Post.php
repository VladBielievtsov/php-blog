<?php

namespace App\controllers;

use App\Services\Router;

class Post {
  public function add ($data, $files) {
    $title = $data['title'];
    $content = $data['content'];

    $image = $files["image"];

    $fileName = time() . '_' . $image["name"];
    $path = "uploads/posts/" . $fileName;

    if (move_uploaded_file($image['tmp_name'], $path)) {
      $post = \R::dispense('posts');
      $post->title = $title;
      $post->content = $content;
      $post->author = $_SESSION['user']['id'];
      $post->date = date('d. M. Y');
      $post->image = "/" . $path;
      $post->views = 0;
      $post->likes = "";
      \R::store($post);
      Router::redirect('/profile');
    } else {
      Router::error("500");
    }
  }

  public static function getAll ($id = null) {
    if (isset($id)) {
      $posts = \R::getAll("SELECT * FROM `posts` WHERE `author` = $id ORDER BY `id` DESC");
      return $posts;
    } else {
      $posts = \R::getAll('SELECT * FROM `posts` ORDER BY `posts`.`id` DESC');
      return $posts;
    }
  }

  public static function getById ($id) {
    $post = \R::getAll("SELECT * FROM `posts` WHERE `id` = $id");
    \R::exec("UPDATE posts SET views = views + 1 WHERE id = $id");

    return $post;
  }

  public static function getAuthor ($id) {
    $getAuthor = \R::findOne('users', 'id = ?', [$id]);
    $author = array(
      "fullname" => $getAuthor->fullname,
      "avatar" => $getAuthor->avatar,
    );
    return $author;
  }

  public static function remove ($id) {
    Router::redirect('/profile');
    $post = \R::load('posts', $id);
    if ($post->id !== 0) {
      \R::trash($post);
    }
  }

  public static function getLikedPosts ($username) {
    $likedPosts = \R::getAll("SELECT * FROM posts");
    $res = [];
    
    foreach ($likedPosts as $posts) {
      if (in_array($username, explode(' ', $posts['likes']))) {
        $res[] = $posts;
      }
    }

    return $res;
  }
}