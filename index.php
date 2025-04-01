<?php
require_once __DIR__ . '/app/controllers/UserController.php';
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/BlogController.php';
// index.php - Root Router 
$request = trim($_SERVER['REQUEST_URI'], '/');; // GET URI
$splitRequest = explode('?', $request);

if (count($splitRequest) === 2) {
  [$path, $queries] = $splitRequest;
} else {
  [$path] = $splitRequest;
}

switch ($path) {  
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

  case 'blog/search.php':
    $controller = new BlogController();
    $param = isset($queries) ? $queries : null;
    $controller->search($param);
    break;

  default:
    $words = explode('/', $request);
    if (count($words) === 3 && $words[1] == 'post') {
      $controller = new BlogController();
      $slug = str_replace('.php', '', $words[2]);
      $controller->read($slug);
      break;
    }
    echo "404 Not Found";
    break;
};
