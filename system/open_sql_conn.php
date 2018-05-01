<?php
  // Database credentials
  $dbserver     = "localhost";
  $dbusername   = "root";
  $dbpassword   = "";
  $db           = "mmogame";

  // Connection
  $conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);

  // Check connection
  if($conn->connect_error) {
    die("Connection Failed: ".$conn->connect_error);
  }
?>
