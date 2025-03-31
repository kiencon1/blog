<?php
  require_once __DIR__ . '/../layout/header.php';
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <form action='sign-in.php' method='POST'>
        <div class='mb-3'>
          <label for='exampleInputUser' class='form-label'>User name</label>
          <input name="username" type='text' class='form-control' id='exampleInputUser'>
          <div id='emailHelp' class='form-text'>We'll never share your information with anyone else.</div>
        </div>
        <div class='mb-3'>
          <label for='exampleInputPassword1' class='form-label'>Password</label>
          <input name="password" type='password' class='form-control' id='exampleInputPassword1'>
          <?php
            if (session_status() === PHP_SESSION_NONE) {
              session_start();
            }
            if (isset($_SESSION['IS_LOGIN_SUCCESS']) && $_SESSION['IS_LOGIN_SUCCESS'] == false) {
              echo "<div class='form-text text-red'>User name or password is incorrect</div>";
              unset($_SESSION['IS_LOGIN_SUCCESS']);
            }
          ?>
        </div>
        <button type='submit' class='btn btn-primary'>Submit</button>
      </form>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
