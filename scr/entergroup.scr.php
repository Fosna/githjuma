<?php
  if (!isset($_POST['entergroup-submit'])) {
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
    $sql = "SELECT * FROM hjuma_users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $user);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
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
      if (!isset($_SESSION['id'])) {

        header("Location: ../login");
      }
      else{
        $_SESSION['group'] = $group;
        header("Location: ../group");
          }
    }
