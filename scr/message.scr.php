<?php
  if (!isset($_POST['send-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();

    $sender_name= $_SESSION['username'];
    $groupmes = $_SESSION['groupname'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $date = date("Y-m-d g:i:sa");
    $sql = "INSERT INTO hjuma_messages (sender_name, groupmes, message, date_time) values ('$sender_name', '$groupmes', '$message', '$date' )";
      if ($conn->query($sql)){
        header ("location: ../group.php");
      }
      else {
        echo "Error".$sql."<br>" . $conn->error;
      }
      $conn->close();
    }
