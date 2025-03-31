<?php
require_once __DIR__ ."/../models/Post.php";

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
      if (isset($_FILES['htmlFile']) && $_FILES['htmlFile']['error'] === UPLOAD_ERR_OK) {
        $title = trim($_POST['title']);
        $categoryID = $_POST['categoryID'];
        $slug = $this->createSlug($title);

        if (session_status() === PHP_SESSION_NONE) {
          session_start();
        }
  
        $userID = $_SESSION['USER_INFO']['userID'];

        $post = new Post($userID, $title, [$categoryID], $slug, $postDAO);
        try {
          $post->create();
        } catch (Exception $e) {
          $_SESSION['CREATE_POST_ERROR'] = $e->getMessage();
          header('Location: blog.php');
          exit();
        }
        

        $fileTmpPath = $_FILES['htmlFile']['tmp_name']; // Đường dẫn tạm thời của file
        $fileName = basename($_FILES['htmlFile']['name']); // Tên gốc của file
        $fileSize = $_FILES['htmlFile']['size']; // Kích thước file
        $fileType = $_FILES['htmlFile']['type']; // Loại file (ví dụ: image/jpeg)

        $uploadDir = __DIR__ . '/../uploads/';
        // Đường dẫn đầy đủ để lưu file
        $destination = $uploadDir . $fileName;

        // Di chuyển file từ thư mục tạm thời đến vị trí đích
        if (move_uploaded_file($fileTmpPath, $destination)) {
          echo "File uploaded successfully: " . $this->createSlug($title);
          $_SESSION['CREATE_POST_SUCCESS'] = 'Create post successfully';
          header('Location: index.php');
          exit();
        } else {
          echo "Failed to move uploaded file.";
        }
      }
    }
  }
}
