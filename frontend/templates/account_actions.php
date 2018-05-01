<?php
  if(isset($_SESSION['loggedin'])) {
?>
  <div class="account-actions">
    <a class="btn btn-primary" href="index.php?page=logout" role="button">Logout</a> <!--<a class="btn btn-primary" href="index.php?page=account" role="button">Account</a> -->
  </div>
<?php
  } else {
?>
  <div class="account-actions">
    <a class="btn btn-primary" href="index.php?page=login" role="button">Login</a> <a class="btn btn-primary" href="index.php?page=register" role="button">Register</a>
  </div>
<?php
  }
?>
