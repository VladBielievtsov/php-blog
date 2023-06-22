<?php

namespace App\controllers;

use App\Services\Router;

class User {
  public static function getAll () {
    $users = \R::getAll('SELECT * FROM `users` ORDER BY `users`.`id` DESC');
    return $users;
  }

  public static function getById ($id) {
    $user = \R::findOne('users', 'id = ?', [$id]);
    if (!$user) {
      Router::redirect('/');
    }
    return $user;
  }
}