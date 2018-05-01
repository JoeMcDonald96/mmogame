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
          <h2>Contact</h2>
          <p>This is the contact page</p>
          <a href="index.php?page=index">Index</a>
          <a href="index.php?page=contact">Contact</a>
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
