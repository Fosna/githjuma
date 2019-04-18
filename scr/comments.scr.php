<?php
  if (!isset($_POST['comment-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $commenter = $_SESSION['username'];
    $groupname = $_SESSION['groupname'];
    $postname = mysqli_real_escape_string($conn, $_POST['postname']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $date = date("Y-m-d g:i:sa");
    if (empty($postname) || empty($comment)){
      header("Location: ../comments?error=empty");
      exit();
    }
    else {
      if (!isset($_SESSION['id'])) {
        header("Location: ../login");
      }
      else{
        $_SESSION['postname'] = $postname;
        $sql1 = "INSERT INTO hjuma_comments (grouppost, post, commenter, comment, date_time) VALUES ('$groupname', '$postname', '$commenter', '$comment', '$date');";
          if ($conn->query($sql1)){
              header("Location: ../comments");
          $conn->close();
          }
        }
    }
  }
