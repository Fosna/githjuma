<?php
if (!isset($_POST['deletegroup-submit'])) {
  exit();
}
else{
  require 'dbh.scr.php';
  session_start();
  $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);

  if (!isset($_SESSION['id'])) {
    header("Location: ../login");
  }
  else{
    $sql = "DELETE FROM hjuma_groups WHERE name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"s", $groupname);
      mysqli_stmt_execute($stmt);
    }
    $sql1 = "DELETE FROM hjuma_messages WHERE groupmes = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"s", $groupname);
      mysqli_stmt_execute($stmt);
    }
    $sql1 = "DELETE FROM hjuma_posts WHERE grouppost = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"s", $groupname);
      mysqli_stmt_execute($stmt);
    }
        $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
        $membercount = mysqli_real_escape_string($conn, $_POST['membercount']);
        $groupmembers = $_SESSION['groupname'];
        $sql = "SELECT * FROM hjuma_users";
        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){
                if ($row['group1'] != "") {
                  $group = "group1";
                }
                elseif ($row['group2'] != "") {
                  $group = "group2";
                }
                elseif ($row['group3'] != "") {
                  $group = "group3";
                }
                elseif ($row['group4'] != "") {
                  $group = "group4";
                }
                elseif ($row['group5'] != "") {
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
          $sql1 = "UPDATE hjuma_users SET $group=NULL WHERE $group=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql1)) {
            echo "SQL error";
          }else {
            mysqli_stmt_bind_param($stmt,"s", $groupname);
            mysqli_stmt_execute($stmt);
          }
          $sql2 = "UPDATE hjuma_groups SET membercount=? - 1 WHERE name=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql2)) {
            echo "SQL error";
          }else {
            mysqli_stmt_bind_param($stmt,"s", $membercount, $groupmembers);
            mysqli_stmt_execute($stmt);
          }

                header("Location: ../main");

        header("Location: ../account");
      }
    }
}
}
