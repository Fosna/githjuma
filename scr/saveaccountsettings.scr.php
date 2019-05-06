<?php
if (!isset($_POST['newname-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $username = $_SESSION['username'];
  $newname = mysqli_real_escape_string($conn, $_POST['newname']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $file = $_FILES['avatar']['tmp_name'];
  $image = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
  $image_name =addslashes($_FILES['avatar']['tmp_name']);
  $image_size = getimagesize($_FILES['avatar']['tmp_name']);
    
        $sql = "SELECT * FROM hjuma_users";
        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
            if ($row['username'] != $newname) {
              $sql1 = "UPDATE hjuma_users SET username=?, profileimage='$image', imagename=?, description=? WHERE username=?;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql1)) {
                echo "SQL error";
              }else {
                mysqli_stmt_bind_param($stmt,"ssss", $newname, $image_name, $description, $username);
                mysqli_stmt_execute($stmt);
              }
                header("Location: logout.scr.php");

            }
          }
        }
      }
  }
