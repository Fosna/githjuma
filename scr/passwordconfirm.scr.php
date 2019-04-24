<?php
if (!isset($_POST['passwordconfirm-submit'])) {
  exit();
}
else{
  $username = $_SESSION['username'];
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $sql = "SELECT * FROM hjuma_users WHERE username = '$username'";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          $pwdCheck = password_verify($password, $row['password']);
          if ($pwdCheck == false) {
            header("Location: ../account");
            exit();
          }
          else if ($pwdCheck == true) {
            session_start();
            header("Location: ../changename.php");
            exit();
          }
        }
      }
    }
}
