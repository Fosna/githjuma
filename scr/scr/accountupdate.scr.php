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


      $sql = "UPDATE hjuma_users SET profileimage='$image', imagename=? WHERE username=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"ss", $imagename, $user);
        mysqli_stmt_execute($stmt);
      }
        header("Location: ../account");
}
