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
          <h2>Home</h2>
          <?php require_once("frontend/templates/account_messages.php") ?>
          <?php
            if(isset($_SESSION['loggedin'])) {
              require_once("system/open_sql_conn.php");

              $username = $_SESSION['loggedin'];

              $query = "SELECT id FROM users WHERE username = '$username'";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              // User data
              $userId = $row['id'];

              // Get city data
              $query = "SELECT id, name FROM cities WHERE id = 1";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              // City data
              $cityId = $row['id'];
              $cityName = $row['name'];

              // Get resources for current user
              $query = "SELECT id, money, supplies, drugs, counterfeit_cash, thieves
                        FROM resources
                        WHERE user_id = '$userId'";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              $resourcesId = $row['id'];
              $money = $row['money'];
              $supplies = $row['supplies'];
              $drugs = $row['drugs'];
              $counterfeit_cash = $row['counterfeit_cash'];
              $thieves = $row['thieves'];

              //Get production
              $query = "SELECT drugs_production, counterfeit_cash_production
              FROM production WHERE city_id = 1";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              $drugs_production = $row['drugs_production'];
              $counterfeit_cash_production = $row['counterfeit_cash_production'];
          ?>
            <center><h3><?php echo $cityName; ?></h3></center>
            <div class="turf-wrapper">
              <div class="resources">
                <h4>Resources</h4>
                <?php
                  echo "$$".$money."</br>".
                  "Supplies: ".$supplies."</br>".
                  "Drugs : ".$drugs."</br>".
                  "Counterfeit Cash: ".$counterfeit_cash."</br>".
                  "Thieves: ".$thieves;
                ?>
                <hr>
                <h5><strong>Production</strong></h5>
                <?php
                  echo "Drug Production: ".$drugs_production."</br>".
                  "Counterfeit Cash Production: ".$counterfeit_cash_production;
                ?>
              </div>
              <div class="turf">
                <?php
                  if(isset($_GET['dru'])) { include("backend/cronjobs/resources.php"); }
                ?>
                <div class="business">
                  <a href="index.php?dru=addDrugs">
                    <img src="frontend/images/durgs_icon.png">
                  </a>
                </div>
                <div class="counterfeit">
                  <a href="index.php?dru=addCoun">
                    <img src="frontend/images/counterfeit.png">
                  </a>
                </div>
              </div>
              <div class="gangs">
                <h4>Gangs</h4>
                <?php require_once("frontend/templates/gang_list.php"); ?>
              </div>
            </div>
          <?php
        } else {
          echo "<p>Please log in.</p></br>";
        }
          ?>
          <a href="index.php?page=index">Index</a>
          -
          <a href="index.php?page=shop">Shop</a>
        </div>
      </div>
      <?php require_once("frontend/templates/footer.php"); ?>
    </div>
  </body>
</html>
