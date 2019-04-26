<?php
if (!isset($_POST['newname-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $username = $_SESSION['username'];
  $newname = mysqli_real_escape_string($conn, $_POST['newname']);
  if (empty($newname)){
    header("Location: ../changename?error=empty");
    exit();
  }
      else {
        $sql = "SELECT * FROM hjuma_users";
        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
            if ($row['username'] != $newname) {
              $sql1 = "UPDATE hjuma_users SET username='$newname' WHERE username='$username';";
                if ($conn->query($sql1)){
                    header("Location: ../login");
                    $conn->close();
                }
            }
          }
        }
      }
    }
  }
