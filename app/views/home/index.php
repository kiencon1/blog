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
      <div class="w-full">
        <?php
          if (isset($ownedPost)) {
            $userName = '';
            if (isset($_SESSION['USER_INFO'])) {
              $userName = $_SESSION['USER_INFO']['userName'];
            }
            
            foreach($ownedPost as $post) {
              $slug = $post['Slug'];
              $categoryName = $post['CategoryName'];
              $updatedAt = $post['UpdatedAt'];
              $title = $post['Title'];
              $author = $userName ? $userName : $post['UserName'];
              echo "<a href='/blog/post/". $slug .".php' class='card w-full text-decoration-none p-30px mb-30px'>";
              echo "<p>In $categoryName by $author </p>";
              echo "<h3>Title: $title</h3>";
              echo "<p>$updatedAt</p></a>";
            }
          }
        ?>
      </div>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
