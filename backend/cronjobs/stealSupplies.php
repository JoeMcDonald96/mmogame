<?php
  if(isset($_POST['nmeId'])) {
    require_once("../../system/open_sql_conn.php"); // Open db connection

    $nmeId = $_POST['nmeId']; // id of user to steal from

    $username = $_GET['username']; // Current username

    // Get current user id, supplies and thieves
    $query = "SELECT users.id, resources.supplies, resources.thieves
              FROM users
              INNER JOIN resources ON users.id = resources.user_id
              WHERE users.id = (
                SELECT id
                FROM users
                WHERE username = '$username'
              )";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Current user data
    $userId = $row['id'];
    $userSupplies = $row['supplies'];
    $userThieves = $row['thieves'];

    // Get user being attacked supplies level
    $query = "SELECT supplies FROM resources WHERE user_id = '$nmeId'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    $nmeSupplies = $row['supplies'];

    // Check user supply levels
    if($nmeSupplies > 0) { // ..Enemy has supplies to steal
      if($userSupplies < 50 && $userSupplies > 0) { // ..user has space for those supplies
        if($userThieves >= 1) { // Check thieves
          // send thief
          $steal = sendThief();
          if($steal) {
            // Steal supplies
            $query = "UPDATE resources
                      SET supplies = supplies + 10
                      WHERE user_id = '$userId'";
            if(mysqli_query($conn, $query)) {
              // Set enemy supplies to zero
              $query = "UPDATE resources
                        SET supplies = supplies - 10
                        WHERE user_id = '$nmeId'";
              if(mysqli_query($conn, $query)) {
                header("Location: ../../index.php?page=index"); // Redirect to index page
                die();
              }
            }
          } else {
            // Unsuccessful attack
            $query = "UPDATE resources
                      SET supplies = supplies - 10,
                      thieves = thieves - 1
                      WHERE user_id = '$userId'";
            if(mysqli_query($conn, $query)) {
              if($nmeSupplies >= 50) {
                header("Location: ../../index.php?page=index"); // Redirect to index page
                die();
              } else {
                $query = "UPDATE resources
                          SET supplies = supplies + 10
                          WHERE user_id = '$nmeId'";
                if(mysqli_query($conn, $query)) {
                  header("Location: ../../index.php?page=index"); // Redirect to index page
                  die();
                }
              }
            }
          }
        }
      }
    }

    header("Location: ../../index.php?page=index"); // Redirect to index page
    die();

  } else {
    echo "not set!";
    header("Location: ../../index.php?page=index"); // Redirect to index page
    die();
  }

  function sendThief() {
    // Generat random numbers for the user and the enemy
    $nmeRand = mt_rand(1, 5);
    $userRand = mt_rand(1, 5);
    // if hte user has a higher/equal number, successful attack
    if($userRand >= $nmeRand) {
      return true;
    }
    return false;
  }
?>
