<?php
  if (isset($_POST['signup-submit'])){
    require 'dbh.scr.php';
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordRp = mysqli_real_escape_string($conn, $_POST['password-rp']);

    if (empty($username) || empty($email) || empty($password) || empty($passwordRp)){
      header("Location: ../hjuma?error=empty&username=".$username."&email=".$email);
      exit();
    }
    else if ((empty($username) || empty($email) || empty($password) || empty($passwordRp)) && (!filter_var($email, FILTER_VALIDATE_EMAIL))){
      header("Location: ../hjuma?error=emptyandmail&username=".$username);
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../hjuma?error=invalidusernameandmail");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      header("Location: ../hjuma?error=invalidemail&username=".$username);
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../hjuma?error=invalidusername&email=".$email);
      exit();
    }
    else if ($password !== $passwordRp){
      header("Location: ../hjuma?error=passwordcheck&username=".$username."&email=".$email);
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
          $sql = "INSERT INTO hjuma_users (username, email, password) VALUES (?, ?, ?)";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../signup?sqlerror");
          }
          else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
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
