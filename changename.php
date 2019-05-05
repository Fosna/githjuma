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
      <button type="button" class="btn btn-success"data-toggle="modal" data-target="#exampleModal" style="display: block; margin-left: auto; margin-right:auto; font-size: 30px;" >Change</button>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      Are you sure you want to change name?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-success"  name="newname-submit">Change</button>
    </div>
  </div>
</div>
</div>
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
