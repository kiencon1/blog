<?php
require_once __DIR__ .'/../models/Post.php';

class HomeController {
  public function index() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      $postDAO = new PostDAO();
      $ownedPost = [];
      if (isset($_SESSION['USER_INFO'])) {
        $userID = $_SESSION['USER_INFO']['userID'];
        $ownedPost = $postDAO->getByUserID($userID);
      } else {
        $ownedPost = $postDAO->getByDefault();
      }

      require __DIR__ . '/../views/home/index.php';
    }
  }
}
