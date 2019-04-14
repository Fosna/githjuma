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
    $sql = "DELETE FROM hjuma_groups WHERE name = '$groupname';";
    $sql1 = "DELETE FROM hjuma_messages WHERE groupmes = '$groupname';";
    $sql1 = "DELETE FROM hjuma_posts WHERE grouppost = '$groupname';";
      if ($conn->query($sql)){
        if ($conn->query($sql1)){
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
            }
          }

        if (!isset($_SESSION['id'])) {
          header("Location: ../login");
        }
        else{
          $sql1 = "UPDATE hjuma_users SET $group=NULL WHERE $group='$groupname';";
          $sql2 = "UPDATE hjuma_groups SET membercount='$membercount' - 1 WHERE name='$groupmembers';";
            if ($conn->query($sql1)){
              if ($conn->query($sql2)){
                header("Location: ../main");
              }
            $conn->close();
            }
          }
        header("Location: ../account");
      }
      else {
        echo "Error".$sql."<br>" . $conn->error;
      }
      $conn->close();
    }
  }
