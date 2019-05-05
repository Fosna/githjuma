<?php
if (!isset($_POST['passwordconfirm-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $username = $_SESSION['username'];
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $sql = "SELECT * FROM hjuma_users WHERE username=?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../account?sqlerror");
    exit();
  }
  else {
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $pwdCheck = password_verify($password, $row['password']);
      if ($pwdCheck == false) {
        header("Location: ../account?error=pwd");
        exit();
      }
      else if ($pwdCheck == true) {
        header("Location: ../changename?check=success");
        exit();
      }
    }
  }
}
