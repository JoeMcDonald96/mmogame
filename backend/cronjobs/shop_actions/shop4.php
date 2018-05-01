<?php
  require_once("../../../system/open_sql_conn.php"); // Open db connection

  $username = $_GET['username']; // Username from shop

  // $query = "SELECT id FROM users WHERE username = '$username'";
  // $result = mysqli_query($conn, $query);
  // $row = mysqli_fetch_assoc($result);
  //
  // $userId = $row['id'];
  //
  // $query = "SELECT money, thieves FROM resources WHERE user_id = '$userId'";
  // $result = mysqli_query($conn, $query);
  // $row = mysqli_fetch_assoc($result);
  //
  // $money = $row['money'];
  // $thieves = $row['thieves'];

  // Get the id, money and thieves belonging to the current user
  $query = "SELECT users.id, resources.money, resources.thieves
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
  $thieves = $row['thieves'];

  // Get price of item being bought
  $query = "SELECT price FROM shop WHERE id = 4";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $price = $row['price'];

  // Check user has enough money and isn't full on that item
  if($money < $price || $thieves >= 5) {
    if($money < $price) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
      die();
    }
    if($thieves >= 5) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
      die();
    }
  } else { // ..otherwise update user resources
    $query = "UPDATE resources
              SET thieves = thieves + 1, money = money - '$price'
              WHERE user_id = '$userId'";
    if(mysqli_query($conn, $query)) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
    }
  }
?>
