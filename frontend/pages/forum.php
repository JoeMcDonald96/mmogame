<?php
  global $title;
  global $seperator;
  global $description;
  global $logo;
?>

<script>
  /**
  * ajax function to update the chat portion of the page when a message is sent
  */
  function ajax() {
    var req = new XMLHttpRequest();

    req.onreadystatechange = function() {
      if(req.readyState == 4 && req.status == 200) {
        document.getElementById('chat').innerHTML = req.responseText;
      }
    }
    req.open('GET', 'backend/cronjobs/chat.php', true);
    req.send();
  }

  setInterval(function() {ajax()}, 1000);
</script>

<html>
  <?php require_once("frontend/templates/head.php"); ?>
  <body onload="ajax();">
    <div class="wrapper">
      <?php require_once("frontend/templates/header.php"); ?>
      <div class="layer">
        <div class="content">
          <?php require_once("frontend/templates/navbar.php"); ?>
          <h2>Chat</h2>
          <p>Welcome to the chat</p>
          <div class="container">

            <?php
            if(isset($_SESSION['loggedin'])) {
              $username = $_SESSION['loggedin'];
              require_once("system/open_sql_conn.php");
              ?>
                <div id="chat-wrapper">
                  <div id="chat_box">
                    <div id="chat"></div>
                  </div>
                    <form action="index.php?page=forum" method="post">
                      <input type="text" name="name" placeholder=" enter your name..."/>
                      <textarea name="message" placeholder=" enter a message..."></textarea>
                      <input type="submit" name="submit" value="Send"/>
                    </form>

                    <?php
                    if(isset($_POST['submit'])) {
                      $name = $_POST['name'];
                      $message = $_POST['message'];

                      $query = "INSERT INTO forum (name, message)
                                       VALUES ('$name', '$message')";

                      $result = $conn->query($query);

                      if($result) {
                        echo "<embed loop='false' src='Blop-Mark_DiAngelo-79054334.wav' hidden='true' autoplay='true'/>";
                      }
                    }
                    ?>

                </div>
              <?php
            } else {
              echo "Please log in.";
            }
            ?>
          </div> <!-- Close container -->
          <!-- <a href="index.php?page=index">Index</a>
          <a href="index.php?page=contact">Contact</a> -->
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
