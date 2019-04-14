<?php
  if (!isset($_POST['leavegroup-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
    $membercount = mysqli_real_escape_string($conn, $_POST['membercount']);
    $groupmembers = $_SESSION['groupname'];
    $sql = "SELECT * FROM hjuma_users";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            if ($row['group1'] == $groupname) {
              $group = "group1";
            }
            if ($row['group2'] == $groupname) {
              $group = "group2";
            }
            if ($row['group3'] == $groupname) {
              $group = "group3";
            }
            if ($row['group4'] == $groupname) {
              $group = "group4";
            }
            if ($row['group5'] == $groupname) {
              $group = "group5";
            }
            else {
              header("Location: ../main");
            }

          }
        }
      }

    if (!isset($_SESSION['id'])) {
      header("Location: ../login");
    }
    else{
      $_SESSION['group'] = $group;
      $user = $_SESSION['username'];
      $sql1 = "UPDATE hjuma_users SET $group=NULL WHERE username ='$user';";
      $sql2 = "UPDATE hjuma_groups SET membercount='$membercount' - 1 WHERE name='$groupmembers';";
        if ($conn->query($sql1)){
          if ($conn->query($sql2)){
            header("Location: ../main");
          }
        $conn->close();
        }
      }
    }
