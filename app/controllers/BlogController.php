<?php
require_once __DIR__ .'/../models/Post.php';
require_once __DIR__ .'/../DAO/CategoryDAO.php';
require_once __DIR__ .'/../DAO/CommentDAO.php';

class BlogController {
  private function createSlug($title) {
    $words = explode(' ', strtolower($title));
    return implode('-', $words);
  }

  public function write() {
    //todo: it will open two connections in method GET, we don't need it
    //using unit of work to resolve it
    $postDAO = new PostDAO();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $categoryDAO = new CategoryDAO();
      $categories = $categoryDAO->getCategories();
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
    $commentDAO = new CommentDAO();
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $post = $postDAO->getPostBySlug($slug);
      $comments = $commentDAO->getBySlug($slug);
      
      require __DIR__ . '/../views/blog/post.php';
    }
  }

  function search($queries) {
    //todo: it will open 3 connections, we don't need it
    //using unit of work to resolve it
    $postDAO = new PostDAO();
    $categoryDAO = new CategoryDAO();
    $userDAO = new UserDAO();

    $categories = $categoryDAO->getCategories();
    $authors = $userDAO->getAuthors();
    
    $searchingPosts = [];

    if ($queries !== null) {
      $title = $_GET['title'] ?? null;
      $categoryID = $_GET['categoryID'] ? (int)($_GET['categoryID']) : null;
      $authorID = $_GET['authorID'] ? (int)($_GET['authorID']) : null;
      
      if ($title != null || $categoryID != null || $authorID != null) {
        $searchingPosts = $postDAO->search($title, $categoryID, $authorID);
      }
    }

    require __DIR__ . '/../views/blog/search.php';
  }

  function comment() {
    $commentDAO = new CommentDAO();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $userID = $_POST['userID'];
      $postID = $_POST['postID'];
      $content = $_POST['content'];

      $commentDAO->comment($userID, $postID, $content);
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $comments = $commentDAO->getByPostID($postID);
    }
  }
}
