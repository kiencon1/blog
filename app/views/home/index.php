<?php
  $__title__ = 'Medium Blog';
  require_once __DIR__ . '/../layout/header.php';
  
?>
  <?php
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
    
    if (isset($_SESSION['message'])) {
      echo '<script>alert("'. $_SESSION['message'] .'")</script>';
      unset($_SESSION['message']);
    }

    if (isset($_SESSION['CREATE_POST_SUCCESS'])) {
      echo '<script>alert("'. $_SESSION['CREATE_POST_SUCCESS'] .'")</script>';
      unset($_SESSION['CREATE_POST_SUCCESS']);
    }
  ?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <h2 class='font-60px'>
        Human
      </h2>
      <h2 class='font-40px text-center'>
        stories & ideas
      </h2>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
