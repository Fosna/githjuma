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

    $sql = "UPDATE hjuma_groups SET maxmembers='$maxmembers', description='$description', privacy='$privacy' WHERE name='$groupname' AND owner='$user'  ";
        if ($conn->query($sql)){
          header("Location: ../group");
          $conn->close();
        }
    }
