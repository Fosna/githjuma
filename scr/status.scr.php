<?php 
if (!isset($_POST['status-submit'])) {
    exit();
  }
  elseif (isset($_POST['status-submit'])) {
    require 'dbh.scr.php';
    $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
    $challenge_status = mysqli_real_escape_string($conn, $_POST['challenge_status']);
    $sql = "UPDATE hjuma_challenges SET challenge_status = '$challenge_status' WHERE challenge_id = '$challenge_id';";
    $conn->query($sql);
    header("Location: ../challenge_info?c=$challenge_id");
  }