<?php
  if (!isset($_POST['like-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $postname = mysqli_real_escape_string($conn, $_POST['postname']);
    $user = $_SESSION['username'];
    $postowner = $_SESSION['postowner'];
    $_SESSION['post'] = $postname;
    $post = $_SESSION['post'];
    $sql = "SELECT * FROM hjuma_users WHERE username=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $postowner);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
          while($row = mysqli_fetch_array($result)){
            $currentlikes = $row['likes'];
            $sql1 = "UPDATE hjuma_users SET likes = ? +1 WHERE username = ? ;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql1)) {
              echo "SQL error";
            }else {
              mysqli_stmt_bind_param($stmt,"ss", $currentlikes, $postowner);
              mysqli_stmt_execute($stmt);
            }
              $sql2 = "INSERT INTO hjuma_likes (user, post, ownerpost) values (?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql2)) {
                echo "SQL error";
              }else {
                mysqli_stmt_bind_param($stmt,"sss", $user, $post, $postowner);
                mysqli_stmt_execute($stmt);
              }
                header("Location: ../group");


    }
  }
}
