<?php
  require_once("../../system/open_sql_conn.php"); // Open db connection

  // Variables from registration from
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  // Encrypt password
  $password = password_hash($password, PASSWORD_BCRYPT);

  // Check user is unique
  $sql = "SELECT username FROM users WHERE username = '$username'";
  if($result = mysqli_query($conn, $sql)) {
    $rowcount = mysqli_num_rows($result);
  }

  if($rowcount >= 1) { // User already exists
    echo "There is already a user with that username!";
  } else {
    // Insert data into database
    $sql = "INSERT INTO users (username, password, email)
    VALUES('$username', '$password', '$email')";

    if($conn->query($sql)) {
      // Get new user id
      $query = "SELECT id FROM users WHERE username = '$username'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);

      $userId = $row['id'];

      // Init values for new users
      $cityId = 1;
      $money = 75000;
      $supplies = 50;
      $drugs = 0;
      $counterfeitCash = 0;
      $thieves = 5;

      //Create resources for new user
      $query = "INSERT INTO resources (user_id, city_id, money, supplies, drugs, counterfeit_cash, thieves)
              VALUES('$userId', '$cityId', '$money', '$supplies', '$drugs', '$counterfeitCash', '$thieves')";

      if($conn->query($query)) {
        header("Location: ../../index.php?msg=registrationsuccess"); // Redirect to index page
        die(); // Break out redirect
      } else {
        echo "ERROR: ".$sql."</br>".$conn->error;
      }
    } else {
      echo "ERROR: ".$sql."</br>".$conn->error;
    }
  }
?>
