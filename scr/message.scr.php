<?php
  if (!isset($_POST['data'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $sender_name= $_SESSION['username'];
    $groupmes = $_SESSION['groupname'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $date = date("Y-m-d g:i:sa");
    if (empty($message)){
      header("Location: ../group?error=empty");
      exit();
    }
    else {
      $sql = "INSERT INTO hjuma_messages (sender_name, groupmes, message, date_time) values (?, ?, ?, ? )";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"ssss", $sender_name, $groupmes, $message, $date );
        mysqli_stmt_execute($stmt);
        echo "inserted";
      }





    }
  }
