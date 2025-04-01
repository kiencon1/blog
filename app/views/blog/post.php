<?php
  $__title__ = 'Medium Blog';
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
        <form action='comment.php' method='post'>
          <div class='mb-3'>
            <label for='exampleInputUser' class='form-label'>Responses</label>
            <textarea placeholder='what are your thoughts?' 
              name='username' type='text' class='form-control' id='exampleInputUser'
            ></textarea>
            <div id='emailHelp' class='form-text'></div>
          </div>
          <button type='submit' class='btn btn-primary'>Submit</button>
        </form>
      </div>
      <div class='w-full my-4'>
        <?php
          if (isset($comments)) {
            //todo
          }
        ?>
        <div class='my-2 border-t-1'>
        <p>Author:<b>Bilui</b><br><i><small>3-March</small></i></p>
          <p>He always says any AI tool can code. But there is always human intervention needed to debug and understand what's going inside.</p>
        </div>
        <div class='my-2 border-t-1'>
          <p>Author:<b>Bilui</b><br><i><small>3-March</small></i></p>
          <p>He always says any AI tool can code. But there is always human intervention needed to debug and understand what's going inside.</p>
        </div>
        <div class='my-2 border-t-1'>
        <p>Author:<b>Bilui</b><br><i><small>3-March</small></i></p>
          <p>He always says any AI tool can code. But there is always human intervention needed to debug and understand what's going inside.</p>
        </div>
      </div>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>