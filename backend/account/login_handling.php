<?php
  session_start(); // Start session

  require_once("../../system/open_sql_conn.php"); // Open db connection

  // Variables from login from
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Get password
  $query = "SELECT password FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $dbPassword = $row['password'];

  // Compare form password to encrypted password in db
  if(password_verify($password, $dbPassword)) {
    // When the user details are correct
    $_SESSION['loggedin'] = $username; // Set session with username
    header("Location: ../../index.php?msg=loginsuccess"); // Redirect to index page
    die(); // Break out redirect
  } else {
    header("Location: ../../index.php?page=login&msg=loginincomplete"); // Redirect to index page
  }
?>
