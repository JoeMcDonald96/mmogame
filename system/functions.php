<?php
  /**
  * Main page routing API
  */
  function getPage() {
    if(isset($_GET['page'])) {
      $page = $_GET['page'];
      if($page == "index") {
        require_once("frontend/pages/index.php");
      } elseif($page == "contact") {
        require_once("frontend/pages/contact.php");
      } elseif($page == "shop") {
        require_once("frontend/pages/shop.php");
      } elseif($page == "forum") {
        require_once("frontend/pages/forum.php");
      } elseif($page == "leaderboard") {
        require_once("frontend/pages/leaderboard.php");
      } elseif($page == "login") {
        require_once("frontend/pages/login.php");
      } elseif($page == "register") {
        require_once("frontend/pages/register.php");
      } elseif($page == "logout") {
        session_destroy();
        echo "logged out!";
        header("Location: index.php?msg=logoutsuccess"); // Redirect to index page
        die(); // Break out redirect
      }
    } else {
      require_once("frontend/pages/index.php");
    }
  }
?>
