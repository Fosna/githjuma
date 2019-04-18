<?php
  if (!isset($_POST['accountupdate-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $file = $_FILES['avatar']['tmp_name'];
    $image = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
    $image_name =addslashes($_FILES['avatar']['tmp_name']);
    $image_size = getimagesize($_FILES['avatar']['tmp_name']);
    $user = $_SESSION['username'];


      $sql = "UPDATE hjuma_users SET profileimage='$image', imagename='$image_name' WHERE username='$user';";
      if ($conn->query($sql)){
        header("Location: ../account");
      }
      else {
        echo "Error".$sql."<br>" . $conn->error;
      }
      $conn->close();
    }
