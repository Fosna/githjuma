<?php
  if (!isset($_POST['profileupdate-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $file = $_FILES['avatar']['tmp_name'];
    $image = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
    $image_name =addslashes($_FILES['avatar']['tmp_name']);
    $image_size = getimagesize($_FILES['avatar']['tmp_name']);
    $owner = $_SESSION['username'];

        $sql1 = "UPDATE hjuma_users SET profileimage='$image'";
      if ($conn->query($sql)){
        header("Location: ../account");
      }
      else {
        echo "Error".$sql."<br>" . $conn->error;
      }
      $conn->close();
    }
