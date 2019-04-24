<?php
if (!isset($_POST['newname-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
    $user = $_SESSION['username'];
    $newname = mysqli_real_escape_string($conn, $_POST['newname']);

    $sql1 = "UPDATE hjuma_users SET username='$newname' WHERE username='$user';";
      if ($conn->query($sql1)){
          header("Location: ../login");
      }
      else {
        echo "Error".$sql1."<br>" . $conn->error;
      }
    $conn->close();
  }
