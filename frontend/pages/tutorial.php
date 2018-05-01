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
          <?php require_once("frontend/templates/navbar.php"); ?>
          <h2>Tutorial</h2>
          <div class="container">
            <?php
            if(isset($_SESSION['username'])) {
              ?>
              <div class="tutorial-wrapper">
                <div class="tut-section">
                  
                </div>
              </div>
              <?php
            } else {
              echo "Please log in.";
            }
            ?>
          </div>
          <!-- <a href="index.php?page=index">Index</a>
          <a href="index.php?page=contact">Contact</a> -->
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
