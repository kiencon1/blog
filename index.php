<?php
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/BlogController.php';
// index.php - Root Router 
$request = trim($_SERVER['REQUEST_URI'], '/');; // GET URI
var_dump($request);
switch ($request) {
  
  case 'blog':
  case 'blog/index.php':
    $controller = new HomeController();
    $controller->index();
    break;

  case 'blog/sign-out.php':
    $controller = new UserController();
    $controller->signOut();
    break;

  case 'blog/sign-in.php':
    $controller = new UserController();
    $controller->signIn();
    break;

  case 'blog/sign-up.php':
    $controller = new UserController();
    $controller->signUp();
    break;

  case 'blog/blog.php':
    $controller = new BlogController();
    $controller->write();
    break;

  default:
    echo "404 Not Found";
    break;
};
