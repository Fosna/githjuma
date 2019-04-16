<?php
if (!isset($_POST['deletecomment-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $commenter = mysqli_real_escape_string($conn, $_POST['commenter']);
  $date_time = mysqli_real_escape_string($conn, $_POST['date_time']);

  if (!isset($_SESSION['id'])) {
    header("Location: ../login");
  }
  else{
    $sql = "DELETE FROM hjuma_comments WHERE commenter = '$commenter' AND date_time = '$date_time';";
      if ($conn->query($sql)){
          header("Location: ../comments");
      }
      else {
        echo "Error".$sql."<br>" . $conn->error;
      }
    $conn->close();
  }
}
