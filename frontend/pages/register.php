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
          <h2>Register</h2>
          <form role="form" action="backend/account/registration_handling.php" method="POST">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail Address:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-default">Register</button>
          </form>
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
