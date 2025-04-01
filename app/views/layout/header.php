<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'
    integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
  <?php 
    echo "<link rel='stylesheet' href='http://localhost/blog/public/css/styles.css'>";
  ?>
  <title><?php echo $__title__ ?? 'Blog'; ?></title>
</head>

<body>
  <header>
    <nav class='navbar h-70px'>
      <div class='container'>
        <a class='navbar-brand' href='/blog'>
          <h1>Medium</h1>
        </a>
        <button class='navbar-toggler' type='button' data-bs-toggle='offcanvas' data-bs-target='#offcanvasDarkNavbar'
          aria-controls='offcanvasDarkNavbar' aria-label='Toggle navigation'>
          <span class='navbar-toggler-icon'></span>
        </button>
        <div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasDarkNavbar'
          aria-labelledby='offcanvasDarkNavbarLabel'>
          <div class='offcanvas-header'>
            <h5 class='offcanvas-title' id='offcanvasDarkNavbarLabel'>
            <?php
              if (session_status() === PHP_SESSION_NONE) {
                session_start();
              }
              if (isset($_SESSION['USER_INFO'])) {
                echo strtoupper($_SESSION['USER_INFO']['userName']);
              } else {
                echo
                "Medium";
              }
            ?>
            </h5>
            <button type='button' class='btn-close btn-close-white' data-bs-dismiss='offcanvas'
              aria-label='Close'></button>
          </div>
          <div class='offcanvas-body'>
            <ul class='navbar-nav justify-content-end flex-grow-1 pe-3'>
              <li class='nav-item'>
                <a class='nav-link' aria-current='page' href='search.php'>Search</a>
              </li>
              <?php
                if (!isset($_SESSION['USER_INFO'])) {
                  echo 
                  "<li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='sign-in.php'>Sign in</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='sign-up.php'>Sign up</a>
                  </li>";
                } else {
                  echo
                  "<li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='blog.php'>Blog</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' aria-current='page' href='sign-out.php'>Sign out</a>
                  </li>";
                }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
