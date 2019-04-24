<?php
  if (!isset($_POST['deletemessage-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $user = $_SESSION['username'];
    $sender = mysqli_real_escape_string($conn, $_POST['sender']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $sql = "DELETE FROM hjuma_messages WHERE message = '$message' AND sender_name = '$sender' AND date_time ='$time';";
      if ($conn->query($sql)){
          header("Location: ../group");
        }
        else {
          echo "Error".$sql."<br>" . $conn->error;
        }
      $conn->close();
    }
