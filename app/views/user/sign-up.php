<?php
  require_once __DIR__ . '/../layout/header.php';
?>
  <main class='main'>
    <div class='container flex justify-center items-center h-full flex-col'>
      <form 
        action='sign-up.php'
        method='post' 
        id='signUpForm'
        onsubmit="return validate(['username', 'password', 'repassword'], 'signUpForm')"
      >
        <div class='mb-3'>
          <label for='usernameIpt' class='form-label'>User name</label>
          <input name='username' type='text' class='form-control' id='usernameIpt'>
          <small id='username' class='text-red'></small>
          <div id='emailHelp' class='form-text'>We'll never share your information with anyone else.</div>
        </div>
        <div class='mb-3'>
          <label for='exampleInputPassword1' class='form-label'>Password</label>
          <input type='password' class='form-control' id='exampleInputPassword1' name='password'>
          <small id='password' class='text-red'></small>
        </div>
        <div class='mb-3'>
          <label for='retypePassword' class='form-label'>Retype Password</label>
          <input type='password' class='form-control' id='retypePassword' name='repassword'>
          <small id='repassword' class='text-red'></small>
        </div>
        <button type='submit' class='btn btn-primary'>Submit</button>
      </form>
    </div>
  </main>
<?php
  require_once __DIR__ . '/../layout/footer.php';
?>
<script src="http://localhost/blog/public/js/validate.js">
  //validate(['username', 'password'], 'signInForm');
</script>
