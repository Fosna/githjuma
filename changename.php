<?php require "header.php"; ?>
<link rel="stylesheet" href="style/login_signup.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<body>
<h1>Change name</h1>

  <div class="container">
    <h1 class="newname">New name</h1>
    <form class="" action="scr/changename.scr.php" method="post">
      <div class="form-group">
      <input class="form-control" type="text" name="newname" value="" required>
    </div>
      <button type="submit" class="btn btn-success" style="display: block; margin-left: auto; margin-right:auto; font-size: 30px;" name="newname-submit">Change</button>
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
