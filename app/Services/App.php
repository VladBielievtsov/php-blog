<?php

namespace App\Services;

class App {
  public static function start() {
    self::libs();
    self::db();
  }
  
  public static function libs () {
    $config = require_once "config/app.php";

    foreach ($config['libs'] as $libs) {
      require_once "libs/" . $libs . ".php";
    }
  }

  public static function db () {
    $config = require_once "config/db.php";

    if ($config["enable"]) {
      \R::setup( 'mysql:host=' . $config["host"] . ';port=' . $config["port"] . ';dbname=' . $config["db"] . '',
          $config["username"], $config["password"] );

      if (!\R::testConnection()) {
        die('Error databesa connect');
      }
    }
  }
}