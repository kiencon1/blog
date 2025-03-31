<?php
  $__title__ = 'Medium Blog';
  require_once __DIR__ . '/../layout/header.php';
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <?php
        if (isset($post)) {
          echo $post['Content'];
        }
      ?>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>