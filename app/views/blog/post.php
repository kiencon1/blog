<?php
  $__title__ = 'Medium Blog';
  $userID = -1;
  $postID = -1;

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_SESSION['USER_INFO'])) {
    $userID = $_SESSION['USER_INFO']['userID'];
  }

  if (isset($post)) {
    $postID = $post['ID'];
  }

  function generateComments($comments) {
    foreach ($comments as $comment) {
      $content = $comment['Content'];
      $date = $comment['UpdatedAt'];
      $name = $comment['Name'];
      echo "<div class='my-2 border-t-1'>
          <p>Author: <b>$name</b><br><i><small>$date</small></i></p>
          <p>$content</p>
        </div>";
    }
  }

  require_once __DIR__ . '/../layout/header.php';
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <div class='w-full my-4'>
        <?php
          if (isset($post)) {
            echo $post['Content'];
          }
        ?>
      </div>
      <div class='w-full my-4 border-t-1 py-4'>
        <?php
          if ($userID > 0) {
            echo "<form id='formCommentID'>
              <div class='mb-3'>
                <label for='exampleInputUser' class='form-label'>Responses</label>
                <textarea placeholder='what are your thoughts?' 
                  name='content' type='text' class='form-control' id='commentID'
                ></textarea>
                <small id='commentError' class='text-red'></small>
                <input class='hidden' id='userID' value='$userID' />
                <input class='hidden' id='postID' value='$postID' />
              </div>
              <button type='submit' class='btn btn-primary'>Submit</button>
            </form>";
          } else {
            echo '<p><i>You must login to comment</i></p>';
          }
        ?>
      </div>
      <div class='w-full my-4' id='commentsID'>
        <?php
          if (isset($comments)) {
            generateComments($comments);
          }
        ?>
      </div>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>

<script src="http://localhost/blog/public/js/comment.js"></script>
