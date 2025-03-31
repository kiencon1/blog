<?php
class HomeController {
  public function index() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      require __DIR__ . '/../views/home/index.php';
    }
  }
}
