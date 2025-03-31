<?php
require_once __DIR__ ."/../DAO/UserDAO.php";

class UserController {
  public function signIn() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      // Hiển thị form đăng nhập
      require __DIR__ . '/../views/user/sign-in.php';
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $userDAO = new UserDAO();
      $result = $userDAO->validateUser($username, $password);
      session_start();
      if ($result['isValid'] === true) {
        $_SESSION['USER_INFO'] = ['userID' => $result['userID'], 'userName' => $username];
        header("Location: index.php");
        exit();
      } else {
        $_SESSION['IS_LOGIN_SUCCESS'] = false;
        header("Location: sign-in.php");
        exit();
      }
    }
  }

  public function signUp() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      require __DIR__ . '/../views/user/sign-up.php';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
      session_start();

      $username = $_POST['username'];
      $password = $_POST['password'];
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $userDAO = new UserDAO();
      $userDAO->create(new User($username, $hashedPassword));
      $_SESSION['message'] = 'create ' . $username .' success';
      header("Location: index.php");
      exit();
    }
  }

  function signOut() {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if (session_status() === PHP_SESSION_NONE) {
        session_start();
      }
      session_destroy();
      if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
      }
      header("Location: index.php");
      exit();
    }
  }
}
