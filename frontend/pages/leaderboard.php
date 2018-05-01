<?php
  global $title;
  global $seperator;
  global $description;
  global $logo;
?>

<html>
  <?php require_once("frontend/templates/head.php"); ?>
  <body>
    <div class="wrapper">
      <?php require_once("frontend/templates/header.php"); ?>
      <div class="layer">
        <div class="content">
          <?php require_once("frontend/templates/navbar.php"); ?>
          <h2>Leaderboard</h2>
          <div class="container">
            <?php
            if(isset($_SESSION['loggedin'])) {
              ?>
              <div class="row">
                <div class="col-sm">
                  <?php echo "Position"; ?>
                </div>
                <div class="col-sm">
                  <?php echo "Username"; ?>
                </div>
                <div class="col-sm">
                  <?php echo "Money"; ?>
                </div>
              </div>
              <?php
              require_once("system/open_sql_conn.php");

              $count = 1;

              $query = "SELECT users.username, resources.money
                        FROM users
                        INNER JOIN resources ON users.id = resources.user_id
                        ORDER BY money DESC";
              $result = mysqli_query($conn, $query);

              while($row = $result->fetch_assoc()) {
                // $user_Id = $row['id'];
                // $query2 = "SELECT money FROM resources WHERE user_id = '$user_Id'";
                // $result2 = mysqli_query($conn, $query2);
                // $row2 = $result2->fetch_assoc();
                // $name = $row['username'];
                // $money = $row2['money'];
                $name = $row['username'];
                $money = $row['money'];
                ?>

                <div class="row">
                  <div class="col-sm">
                    <?php echo $count; ?>
                  </div>
                  <div class="col-sm">
                    <?php echo $name; ?>
                  </div>
                  <div class="col-sm">
                    <?php echo $money; ?>
                  </div>
                </div>
                <?php
                $count++;
              }
            } else {
              echo "Please Log in.";
            }
            ?>

          </div>
          <!-- <a href="index.php?page=index">Index</a>
          <a href="index.php?page=contact">Contact</a> -->
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
