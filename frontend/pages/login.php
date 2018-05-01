<?php
  global $title;
  global $seperator;
  global $description;
  global $logo;
?>

<html>
  <?php require_once("frontend/templates/head.php"); ?>
  <body>
    <div class="wrapper">
      <?php require_once("frontend/templates/header.php"); ?>
      <div class="layer">
        <div class="content">
          <h2>Login</h2>
          <?php require_once("frontend/templates/account_messages.php") ?>
          <form role="form" action="backend/account/login_handling.php" method="POST">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-default">Login</button>
          </form>
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
