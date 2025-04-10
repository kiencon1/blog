<?php
  require_once __DIR__ . '/../layout/header.php';
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <form id='blogForm' onsubmit='return validate(["title", "categoryID", "content"], "blogForm")'
        action='blog.php' method='POST' class='w-full m-h-600px'>
        <div class='mb-3'>
          <label for='titleIpt' class='form-label'>Title</label>
          <input name='title' type='text' class='form-control' id='titleIpt'>
          <small id='title' class='text-red'></small>
          <?php
          if (isset($_SESSION['CREATE_POST_ERROR'])) {
            echo "<div class='form-text text-red'>". $_SESSION['CREATE_POST_ERROR'] ."</div>";
            unset($_SESSION['CREATE_POST_ERROR']);
          }
          ?>
        </div>
        <div class='mb-3'>
          <label for='categoryIpt' class='form-label'>Category</label>
          <select class='form-select' name='categoryID' id='categoryIpt'>
            <?php
              if (isset($categories)) {
                for($i = 0; $i < count($categories); $i++) {
                  $id = $categories[$i]['ID'];
                  $name = $categories[$i]['Name'];
                  if ($i === 0) {
                    echo "<option selected value='$id'>$name</option>";
                  } else {
                    echo "<option value='$id'>$name</option>";
                  }
                }
              }
            ?>
          </select>
          <small id='categoryID' class='text-red'></small>
        </div>
        <div class='mb-3'>
          <label for='contentIpt' class='form-label'>Content</label>
          <textarea name='content' type='file' class='form-control overflow-y-scroll' id='contentIpt'></textarea>
          <small id='content' class='text-red'></small>
        </div>
        <button type='submit' class='btn btn-primary'>Submit</button>
      </form>
    </div>
  </main>
  <script src="http://localhost/blog/public/js/validate.js"></script>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
