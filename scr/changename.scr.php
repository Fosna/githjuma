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
    $sql = "SELECT username FROM hjuma_users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)){
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);
      $result = mysqli_stmt_num_rows($stmt);
      if ($result > 0) {
        header("Location: ../changename?error=usernametaken");
        exit();
      }
      else {
        $sql1 = "UPDATE hjuma_users SET username='$newname' WHERE username='$username';";
          if ($conn->query($sql1)){
              header("Location: ../login");
              $conn->close();
          }
      }
    }
  }
}
