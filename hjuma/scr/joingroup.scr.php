<?php
  if (!isset($_POST['joingroup-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';

    session_start();
    $user = $_SESSION['username'];
    $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
    $membercount = mysqli_real_escape_string($conn, $_POST['membercount']);
    $_SESSION['groupname'] = $groupname;
    $groupmembers = $groupname;
    $owner = $_SESSION['username'];
    $sql = "SELECT * FROM hjuma_users";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            if ($row['group1'] == "") {
              $group = "group1";
            }
            elseif ($row['group2'] == "") {
              $group = "group2";
            }
            elseif ($row['group3'] == "") {
              $group = "group3";
            }
            elseif ($row['group4'] == "") {
              $group = "group4";
            }
            elseif ($row['group5'] == "") {
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
      $sql1 = "UPDATE hjuma_users SET $group='$groupname' WHERE username='$user';";
      $sql = "SELECT * FROM hjuma_groups WHERE name='$groupname'";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
              $membercount = $row['membercount'];
      $sql2 = "UPDATE hjuma_groups SET membercount='$membercount' + 1 WHERE name='$groupmembers';";
        if ($conn->query($sql1)){
          if ($conn->query($sql2)){
            header("Location: ../group");
          }
        $conn->close();
        }
      }
    }
  }
}
}