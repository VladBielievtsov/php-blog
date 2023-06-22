<?php

namespace App\controllers;

use App\Services\Router;

class Auth {

  public function login ($data) {
    $email = $data['email'];
    $password = $data['password'];

    $user = \R::findOne('users', 'email = ?', [$email]);

    if (!$user) {
      die('User not found!');
    }

    if (password_verify($password, $user->password)) {
      session_start();
      $_SESSION["user"] = [
        "id" => $user->id,
        "fullname" => $user->fullname,
        "username" => $user->username,
        "group" => $user->group,
        "email" => $user->email,
        "avatar" => $user->avatar,
      ];
      Router::redirect('/profile');
    } else {
      die('Error login or password!');
    }
  }

  public function register ($data, $files) {
    $email = $data['email'];
    $username = $data['username'];
    $fullname = $data['fullname'];
    $password = $data['password'];
    $password_confirm = $data['password_confirm'];

    if ($password !== $password_confirm) {
      Router::error("500");
      die();
    }

    $avatar = $files["avatar"];

    $fileName = time() . '_' . $avatar["name"];
    $path = "uploads/avatars/" . $fileName;

    $errors = array();

    if (\R::count('users', "email = ?", array($email)) > 0){
      $errors[] = 'email already taken!';
    }
    if (\R::count('users', "username = ?", array($username)) > 0){
      $errors[] = 'username already taken!';
    }

    if (empty($errors)) {
      if (move_uploaded_file($avatar["tmp_name"], $path)) {
        $user = \R::dispense('users');
        $user->email = $email;
        $user->username = $username;
        $user->fullname = $fullname;
        $user->group = 1; // 1 user, 2 admin
        $user->avatar = "/" . $path;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        \R::store($user);
        Router::redirect('/login');
      } else {
        Router::error("500");
      }
    } else {
      Router::redirect('/register?err=' . array_shift($errors));
    }
  }

  public function logout () {
    unset($_SESSION['user']);
    Router::redirect('/login');
  }
}