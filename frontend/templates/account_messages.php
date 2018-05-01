<?php
  if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if($msg == "loginsuccess") {
      $msg = "Successfully Logged In!";
    } elseif($msg == "registrationsuccess") {
      $msg = "Registration Complete.";
    } elseif($msg == "logoutsuccess") {
      $msg = "Logged Out!";
    } elseif($msg == "loginincomplete") {
      $msg = "Username or Password is Incorrect! Try again.";
    }
    ?>
    <div class="alert alert-success" role="alert"><?php echo $msg; ?></div>
    <?php
  }
?>
