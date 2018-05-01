<?php
  require_once("../../system/open_sql_conn.php"); // Open db connection

  /**
  * Turns the date object passed in into a more readable
  * format for display.
  */
  function formatDate($date) {
    return date('g:i a', strtotime($date));
  }

  // Get all chat rows
  $query = "SELECT * FROM forum ORDER BY id DESC";
  $result = $conn->query($query);
  // Loop, appending chat rows to screen
  while($row = $result->fetch_array()) :
?>
<div id="chat_content">
  <span style="color:green"><?php echo $row['name']; ?></span> :
  <span><?php echo $row['message']; ?></span>
  <span style="float:right"><?php echo formatDate($row['date']); ?></span>
</div>

<?php endwhile; ?>
