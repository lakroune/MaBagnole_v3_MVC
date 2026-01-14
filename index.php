<?php

require_once __DIR__ . '/vendor/autoload.php';

use core\Router;


$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$path = trim($path, '/');
$route = explode('/', $path);
array_shift($route);
$run = (new Router($route))->run();
