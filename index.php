<?php

error_reporting(E_ERROR | E_PARSE);

session_start();

use App\Services\App;

require_once __DIR__ . "/vendor/autoload.php";
App::start();
require_once __DIR__ . "/router/routes.php";