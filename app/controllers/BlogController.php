<?php
require_once __DIR__ .'/../models/Post.php';

class BlogController {
  private function createSlug($title) {
    $words = explode(' ', strtolower($title));
    return implode('-', $words);
  }

  public function write() {
    $postDAO = new PostDAO();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $categories = $postDAO->getCategories();
      require __DIR__ . '/../views/blog/blog.php';
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = trim($_POST['title']);
      $categoryID = $_POST['categoryID'];
      $content = $_POST['content'];
      $slug = $this->createSlug($title);

      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }

      $userID = $_SESSION['USER_INFO']['userID'];

      $post = new Post($userID, $title, [$categoryID], $slug, $content, $postDAO);
      try {
        $post->create();
        $_SESSION['CREATE_POST_SUCCESS'] = 'Create post successfully';
        header('Location: index.php');
      } catch (Exception $e) {
        $_SESSION['CREATE_POST_ERROR'] = $e->getMessage();
        header('Location: blog.php');
      }
      exit();
    }
  }

  public function read($slug) {
    $postDAO = new PostDAO();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $post = $postDAO->getPostBySlug($slug);
      require __DIR__ . '/../views/blog/post.php';
    }
  }
}
