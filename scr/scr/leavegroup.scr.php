<?php
  if (!isset($_POST['leavegroup-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
        $user = $_SESSION['username'];
    $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
    $membercount = mysqli_real_escape_string($conn, $_POST['membercount']);
    $groupmembers = $_SESSION['groupname'];
    $sql = "SELECT * FROM hjuma_users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $user);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
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

      $sql1 = "UPDATE hjuma_users SET $group=NULL WHERE username =?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql1)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"s", $user);
        mysqli_stmt_execute($stmt);
      }
      $sql = "SELECT * FROM hjuma_groups WHERE name=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt, "s", $groupname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_array($result)){
              $membercount = $row['membercount'];
      $sql2 = "UPDATE hjuma_groups SET membercount=? - 1 WHERE name=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql2)) {
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt,"ss", $membercount, $groupmembers);
        mysqli_stmt_execute($stmt);
      }
            header("Location: ../main");

        $conn->close();
      }
    }
  }
