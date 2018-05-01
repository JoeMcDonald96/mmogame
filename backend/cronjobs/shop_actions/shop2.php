<?php
  require_once("../../../system/open_sql_conn.php"); // Open db connection

  $username = $_GET['username']; // Get username

  // Get the id, money and drugs belonging to the current user
  $query = "SELECT users.id, resources.money, resources.drugs
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
  $drugs = $row['drugs'];

  // Get price of item being bought
  $query = "SELECT price FROM shop WHERE id = 2";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $price = $row['price'];

  // if the user has no drugs to sell
  if($drugs <= 0) {
    header("Location: ../../../index.php?page=shop"); // Redirect to index page
    die();
  } else { // ..otherwise, buy the item
    $moneyToAdd = $drugs * $price; // Number of user's drugs times their price
    // Update user drugs level and money
    $query = "UPDATE resources
              SET drugs = 0, money = money + '$moneyToAdd'
              WHERE user_id = '$userId'";
    if(mysqli_query($conn, $query)) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
    }
  }
?>
