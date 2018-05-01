<?php
  require_once("system/open_sql_conn.php"); // Open db connection

  $username = $_SESSION['loggedin']; // Get logged in user

  // Get resources belonging to the user
  $query = "SELECT users.id, resources.supplies, resources.drugs, resources.counterfeit_cash
            FROM users
            INNER JOIN resources ON users.id = resources.user_id
            WHERE users.id = (
              SELECT id
              FROM users
              WHERE username = '$username'
            )";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();

  $supplies = $row['supplies'];
  $drugs = $row['drugs'];
  $counterfeitCash = $row['counterfeit_cash'];

  // Get production rates
  $query = "SELECT drugs_production, counterfeit_cash_production
            FROM production
            WHERE id = 1";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $drugs_production = $row['drugs_production'];
  $counterfeit_cash_production = $row['counterfeit_cash_production'];

  // if buisness buttons on index map clicked
  if(isset($_GET['dru'])) {
    $resType = $_GET['dru'];

    // Check if enough supplies
    if($supplies <= 0) {
      header("Location: index.php"); // Redirect to index page
      die();
    } else {
      // Check if enough room to make more stuff
      if($drugs >= 50 || $counterfeitCash >= 50) {
        header("Location: index.php"); // Redirect to index page
        die();
      } else {
        if($resType == "addDrugs") {
          // Increase drugs and reduce supplies
          $query = "UPDATE resources
                    SET drugs = drugs + '$drugs_production', supplies = supplies - 10
                    WHERE user_id = '$userId'";
          if(mysqli_query($conn, $query)) {
            header("Location: index.php"); // Redirect to index page
            die();
          }
        }

        if($resType == "addCoun") {
          // Increase counterfeit cash and reduce supplies
          $query = "UPDATE resources
                    SET counterfeit_cash = counterfeit_cash + '$counterfeit_cash_production',
                    supplies = supplies - 10
                    WHERE user_id = '$userId'";
          if(mysqli_query($conn, $query)) {
            header("Location: index.php"); // Redirect to index page
            die();
          }
        }
      }
    }
  }
?>
