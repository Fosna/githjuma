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
    $sql = "SELECT * FROM hjuma_users WHERE username='$postowner'";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            $currentlikes = $row['likes'];

    $sql1 = "UPDATE hjuma_users SET likes = '$currentlikes'+1 WHERE username = '$postowner';";
      $sql2 = "INSERT INTO hjuma_likes (user, post, ownerpost) values ('$user','$post','$postowner')";
      if ($conn->query($sql1)){
        if ($conn->query($sql2)){
        header("Location: ../group");
      }
    }
      else {
        echo "Error".$sql1."<br>" . $conn->error;
      }
      $conn->close();
      }
    }
  }
}
