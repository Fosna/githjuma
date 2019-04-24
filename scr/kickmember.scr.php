<?php
if (!isset($_POST['kick-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
    $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
  if (!isset($_SESSION['id'])) {
    header("Location: ../login");
  }
  else{
    $sql = "SELECT * FROM hjuma_users WHERE username = '$user'";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){


            if ($row['group1'] == $groupname) {
              $group = 'group1';
            }
            elseif ($row['group2'] == $groupname) {
              $group = 'group2';
            }
            elseif ($row['group3'] == $groupname) {
              $group = 'group3';
            }
            elseif ($row['group4'] == $groupname) {
              $group = 'group4';
            }
            elseif ($row['group5'] == $groupname) {
            $group = 'group5';
            }
            else {
              header("Location: ../main");
            }
          }
        }
      }
    $sql1 = "UPDATE hjuma_users SET $group=NULL WHERE username='$user';";
      if ($conn->query($sql1)){
          header("Location: ../main");
      }
      else {
        echo "Error".$sql1."<br>" . $conn->error;
      }
    $conn->close();
  }
}
