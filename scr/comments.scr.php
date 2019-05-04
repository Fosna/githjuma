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
    $post_time = mysqli_real_escape_string($conn, $_POST['post_time']);
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
        $sql1 = "INSERT INTO hjuma_comments (grouppost, post, commenter, comment, date_time, post_time) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql1)) {
          echo "SQL error";
        }else {
          mysqli_stmt_bind_param($stmt,"ssssss", $groupname, $postname, $commenter, $comment, $date, $post_time);
          mysqli_stmt_execute($stmt);
        }
        header("Location: ../comments");

        }
    }
  }
