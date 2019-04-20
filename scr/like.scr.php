<?php
  if (!isset($_POST['like-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $postowner = $_SESSION['postowner'];
    $sql = "SELECT * FROM hjuma_users WHERE username='$postowner'";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            $currentlikes = $row['likes'];

    $sql1 = "UPDATE hjuma_users SET likes = '$currentlikes'+1 WHERE username = '$postowner';";
      if ($conn->query($sql1)){
        header("Location: ../group");
      }
      else {
        echo "Error".$sql1."<br>" . $conn->error;
      }
      $conn->close();
      }
    }
  }
}
