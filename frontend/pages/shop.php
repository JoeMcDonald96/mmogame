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
          <h2>Black Market</h2>
          <p>Welcome to the black market</p>
            <div class="container">
              <?php
              if(isset($_SESSION['loggedin'])) {
                require_once("system/open_sql_conn.php");

                $username = $_SESSION['loggedin'];

                $query = "SELECT id FROM users WHERE username = '$username'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                $userId = $row['id'];

                // Get resource id
                $query = "SELECT id FROM resources WHERE user_id = '$userId'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                $resourcesId = $row['id'];

                // Get resources
                $query = "SELECT money, supplies, drugs, counterfeit_cash, thieves FROM resources WHERE id = '$resourcesId'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                $money = $row['money'];
                $supplies = $row['supplies'];
                $drugs = $row['drugs'];
                $counterfeit_cash = $row['counterfeit_cash'];
                $thieves = $row['thieves'];

                ?>

                <div class="Shop-stats">
                  <h4>Resources</h4>
                  <?php
                    echo "$$".$money."</br>".
                    "Supplies: ".$supplies."</br>".
                    "Drugs : ".$drugs."</br>".
                    "Counterfeit Cash: ".$counterfeit_cash."</br>".
                    "Thieves: ".$thieves;
                  ?>
                  <hr>
                </div>
                <form id="shopForm" action="shop0.php" method="post">
                <?php

                $count = 1;

                $query = "SELECT * FROM shop";
                $result = mysqli_query($conn, $query);
                while($row = $result->fetch_assoc()) {
                  $name = $row['name'];
                  $price = $row['price'];
                  $type = "";

                  if($row['type'] == 0) {
                    $type = "Buy";
                  } elseif($row['type'] == 1) {
                    $type = "Sell";
                  }
                  ?>

                    <div class="row">
                      <div class="col-sm">
                        <?php echo $name; ?>
                      </div>
                      <div class="col-sm">
                        <?php echo "$".$price; ?>
                      </div>
                      <div class="col-sm">
                        <button type="submit"
                                name="<?php echo $name; ?>"
                                onclick="submitForm('backend/cronjobs/shop_actions/shop<?php echo $count; ?>.php?username=<?php echo $username; ?>')"
                        >
                                <?php echo $type; ?>
                        </button>
                      </div>
                    </div>
                  <?php
                  $count++;
                }
              } else {
                echo "<p>Please log in.</p></br>";
              }

              ?>
            </div>
          </form>

          <script>
              function submitForm(action)
              {
                  document.getElementById('shopForm').action = action;
                  document.getElementById('shopForm').submit();
              }
          </script>
          <!-- <a href="index.php?page=index">Index</a>
          <a href="index.php?page=contact">Contact</a> -->
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
