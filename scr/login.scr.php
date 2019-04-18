<?php
if (!isset($_POST['login-submit'])) {
  exit();
}
elseif (isset($_POST['login-submit'])) {
  require 'dbh.scr.php';

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (empty($username) || empty($password)){
    header("Location: ../login?error=empty");
    exit();
  }
  else {
    $sql = "SELECT * FROM hjuma_users WHERE username=? OR email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../login?sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "ss", $username, $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['password']);
        if ($pwdCheck == false) {
          header("Location: ../login?error=pwd");
          exit();
        }
        else if ($pwdCheck == true) {
          session_start();
          $_SESSION['id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          header("Location: ../main?login=success");
          exit();
        }
      }
      else {
        header("Location: ../login?error=nouser");
      }
    }
  }
}
else {
  header("Location: ../main");
  exit();
}
