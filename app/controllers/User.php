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

  public static function searchUser ($str) {
    $users = \R::getAll("SELECT * FROM `users` WHERE `username` LIKE '%$str%' OR `fullname` LIKE '%$str%'");
    return $users;
  }
}