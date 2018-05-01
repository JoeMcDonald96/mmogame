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
  } else {
    $query = "SELECT name, seperator, description, maintenance, logo FROM configuration";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // General Variables
    $title        = $row['name'];
    $seperator    = $row['seperator'];
    $description  = $row['description'];
    $logo         = $row['logo'];


    // Technical variables
    $maintenance  = $row['maintenance'];
  }
?>
