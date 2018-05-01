<?php
  require_once("../../../system/open_sql_conn.php"); // Open db connection

  $username = $_GET['username']; // Username from shop

  // Get the id, money and supplies belonging to the current user
  $query = "SELECT users.id, resources.money, resources.supplies
            FROM users
            INNER JOIN resources ON users.id = resources.user_id
            WHERE users.id = (
              SELECT id
              FROM users
              WHERE username = '$username'
            )";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $userId = $row['id'];
  $money = $row['money'];
  $supplies = $row['supplies'];

  // Get price of item being bought
  $query = "SELECT price FROM shop WHERE id = 1";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $price = $row['price'];

  // If user can't afford item or already is full on that item
  if($money < $price || $supplies >= 50) {
    if($money < $price) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
      die();
    }
    if($supplies >= 50) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
      die();
    }
  } else { // ...otherwise buy that item
    $suppToAdd = 50 - $supplies; // max supplies - current supplies
    // Update user moneu and supplies
    $query = "UPDATE resources
              SET supplies = supplies + '$suppToAdd', money = money - '$price'
              WHERE user_id = '$userId'";
    if(mysqli_query($conn, $query)) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
    }
  }
?>
