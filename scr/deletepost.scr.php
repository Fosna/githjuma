<?php
if (!isset($_POST['deletepost-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $postname = mysqli_real_escape_string($conn, $_POST['postname']);
  $owner = mysqli_real_escape_string($conn, $_POST['postowner']);
  $date = mysqli_real_escape_string($conn, $_POST['date_time']);

  if (!isset($_SESSION['id'])) {
    header("Location: ../login");
  }
  else{
    $sql = "DELETE FROM hjuma_comments WHERE grouppost = '$postname';";
    $sql1 = "DELETE FROM hjuma_posts WHERE title = '$postname' AND owner = '$owner' AND date_time ='$date';";
      if ($conn->query($sql)){
        if ($conn->query($sql1)){
          header("Location: ../group");
        }
        else {
          echo "Error".$sql."<br>" . $conn->error;
        }
      $conn->close();
    }
  }
}
