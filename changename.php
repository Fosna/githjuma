<?php require "header.php"; ?>
<link rel="stylesheet" href="style/changename.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<body>
<h1>Change name</h1>

  <div class="changename_container">
    <h1 class="newname">New name</h1>
    <form class="" action="scr/changename.scr.php" method="post">
      <input class="input_newname" type="text" name="newname" value="" required>
      <button type="submit" class="submitbtn" name="newname-submit">Change</button>
    </form>
  </div>
  <?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "empty") {
      echo '<div class="error">Fill field!</div>';
    }
    elseif ($error == "usernametaken") {
      echo '<div class="error">Username taken!</div>';
    }
  }
  ?>
</body>
