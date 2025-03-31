<?php
  require_once __DIR__ . '/../layout/header.php';
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <form action='sign-up.php' method='post'>
        <div class='mb-3'>
          <label for='usernameIpt' class='form-label'>User name</label>
          <input name='username' type='text' class='form-control' id='usernameIpt'>
          <div id='emailHelp' class='form-text'>We'll never share your information with anyone else.</div>
        </div>
        <div class='mb-3'>
          <label for='exampleInputPassword1' class='form-label'>Password</label>
          <input type='password' class='form-control' id='exampleInputPassword1' name='password'>
        </div>
        <div class='mb-3'>
          <label for='retypePassword' class='form-label'>Retype Password</label>
          <input type='password' class='form-control' id='retypePassword'>
        </div>
        <button type='submit' class='btn btn-primary'>Submit</button>
      </form>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
