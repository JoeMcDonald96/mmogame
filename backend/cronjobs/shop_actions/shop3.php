<?php
  require_once("../../../system/open_sql_conn.php"); // Open db connection

  $username = $_GET['username']; // Username from shop

  // $query = "SELECT id FROM users WHERE username = '$username'";
  // $result = mysqli_query($conn, $query);
  // $row = mysqli_fetch_assoc($result);
  //
  // $userId = $row['id'];
  //
  // $query = "SELECT money, counterfeit_cash FROM resources WHERE user_id = '$userId'";
  // $result = mysqli_query($conn, $query);
  // $row = mysqli_fetch_assoc($result);
  //
  // $money = $row['money'];
  // $counterfeitCash = $row['counterfeit_cash'];

  // Get the id, money and counterfeit cash belonging to the current user
  $query = "SELECT users.id, resources.money, resources.counterfeit_cash
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
  $counterfeitCash = $row['counterfeit_cash'];

  // Get price of item being bought
  $query = "SELECT price FROM shop WHERE id = 3";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $price = $row['price'];

  // If user has no counterfeit cash to sell
  if($counterfeitCash <= 0) {
    header("Location: ../../../index.php?page=shop"); // Redirect to index page
    die();
  } else { // ..otherwise, sell item
    $moneyToAdd = $counterfeitCash * $price; // User's counterfeit cash * price
    // Update user's counterfeit cash and money
    $query = "UPDATE resources
              SET counterfeit_cash = 0, money = money + '$moneyToAdd'
              WHERE user_id = '$userId'";
    if(mysqli_query($conn, $query)) {
      header("Location: ../../../index.php?page=shop"); // Redirect to index page
    }
  }
?>
