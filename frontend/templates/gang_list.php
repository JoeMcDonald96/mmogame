<?php
  require_once("system/open_sql_conn.php");
  $username = $_SESSION['loggedin'];

  // Get current user's id
  $query = "SELECT id FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);

  $userId = $row['id'];

  ?>
  <div class="gangList">
    <form id="gangsForm" action="backend/cronjobs/stealSupplies.php?username=<?php echo $username ?>" method="post">
    <?php

    // Get all users other than 'this' user
    $query = "SELECT id, username FROM users WHERE id != '$userId'";
    $result = mysqli_query($conn, $query);
    while($row = $result->fetch_assoc()) {
      $nmeId       = $row['id'];
      $nmeUsername = $row['username'];

      $query2 = "SELECT supplies FROM resources WHERE user_id = '$nmeId'";
      $result2 = mysqli_query($conn, $query2);
      $row2 = mysqli_fetch_assoc($result2);

      $nmeSupplies = $row2['supplies'];

      ?>
      <div class="gangWrapper">
        <div class="container">
          <div class="row">
            <div class="col-sm">
              <?php echo "Gang:"; ?>
            </div>
            <div class="col-sm">
              <?php echo $nmeUsername; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm">
              <?php echo "Supplies:"; ?>
            </div>
            <div class="col-sm">
              <?php echo $nmeSupplies; ?>
            </div>
          </div>
          <div class="row">
            <button type="submit"
                    name="nmeId"
                    value="<?php echo $nmeId; ?>"
            >
            Steal Supplies
            </button>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </form>
  </div>
