<?php
  if (isset($_POST['signup-submit'])){
    require 'dbh.scr.php';
    $user_id = uniqid();
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $theme = "dark";
    $passwordRp = mysqli_real_escape_string($conn, $_POST['password-rp']);

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $passwordRp = filter_var($passwordRp, FILTER_SANITIZE_STRING);

    $maxchar = strlen($username);

    if (empty($username) || empty($email) || empty($password) || empty($passwordRp)){
      header("Location: ../signup?error=empty");
      exit();
    }
    elseif ($maxchar > 10) {
      header("Location: ../signup?error=maxchar");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../signup?error=email");
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../signup?error=username");
      exit();
    }
    else if ($password !== $passwordRp){
      header("Location: ../signup?error=pwd");
      exit();
    }
    else {
      $sql = "SELECT username FROM hjuma_users WHERE username=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../signup?sqlerror");
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result = mysqli_stmt_num_rows($stmt);
        if ($result > 0) {
          header("Location: ../signup?error=usernametaken&email=".$email);
          exit();
        }
        else {
          $sql = "INSERT INTO hjuma_users (id, username, email, password) VALUES (?, ?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup?sqlerror");
          }
          else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "ssss", $user_id, $username, $email, $hashedPwd);
            mysqli_stmt_execute($stmt);
            header("Location: ../login?signup=success");
            exit();
          }
        }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
  }
  else {
    header("Location: ../signup");
    exit();
  }
