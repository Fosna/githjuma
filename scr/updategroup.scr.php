<?php
  if (!isset($_POST['updategroup-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $privacy = mysqli_real_escape_string($conn, $_POST['privacy']);
    $maxmembers = mysqli_real_escape_string($conn, $_POST['maxmembers']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $user = $_SESSION['username'];
    $groupname = $_SESSION['groupname'];

    $sql = "UPDATE hjuma_groups SET maxmembers= ?, description= ?, privacy= ? WHERE name= ? AND owner= ? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt,"sssss", $maxmembers, $description, $privacy, $groupname, $user);
      mysqli_stmt_execute($stmt);
    }

          header("Location: ../group");

    }
