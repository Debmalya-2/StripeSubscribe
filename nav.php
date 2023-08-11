<?php
  $loggedIn = false;
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $loggedIn = true;
  }
  echo '<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="/stripe">Proof of Concept App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/stripe/plan.php">Plans</a>
          </li>';
          if(!$loggedIn){
            echo '
            <li class="nav-item">
              <a class="nav-link" href="/stripe/login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/stripe/register.php">Signup</a>
            </li>';
          }
          else{
            echo '<li class="nav-item">
              <a class="nav-link" href="/stripe/logout.php">Logout</a>
            </li>
            
            </ul>
            <li class="nav-item d-flex">
            Welcome!&nbsp<b>'.$_SESSION['usermail'].'</b>
          </li>
        ';}echo '
      </div>
    </div>
  </nav>';
?>