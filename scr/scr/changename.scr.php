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
              $sql1 = "UPDATE hjuma_users SET username=? WHERE username=?;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql1)) {
                echo "SQL error";
              }else {
                mysqli_stmt_bind_param($stmt,"ss", $newname, $username);
                mysqli_stmt_execute($stmt);
              }
                header("Location: logout.scr.php");

            }
          }
        }
      }
    }
  }
