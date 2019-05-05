<?php
  require 'dbh.scr.php';
  if(isset($_REQUEST["term"])){
      session_start();
      $sql = "SELECT * FROM hjuma_users WHERE username LIKE ? LIMIT 6";
      if($stmt = mysqli_prepare($conn, $sql)){
          $param_term = '%%' . $_REQUEST["term"] . '%%';
          mysqli_stmt_bind_param($stmt, "s", $param_term);
          if(mysqli_stmt_execute($stmt)){
              $result = mysqli_stmt_get_result($stmt);
              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
                        <div class="searchresult1">
                          <form class="" action="scr/sendfriendreq.scr.php" method="post">
                            <p class="username"><?php echo $row['username']; ?></p>
                            <button style="float: right;" type="submit" class="btn btn-success" id="invitebtn" name="inviteuser-submit">Make friend!</button>
                            <input type="hidden"  name="receiver" value="<?php echo $row['username']  ?>">
                            <input type="hidden" name="sender" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden"  name="groupname" value="<?php echo $groupname;?>">
                          </form>
<?php
                  echo "</div>";
                  }
              } else{
                  //echo "<p> No match!</p>";
              }
          } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
      }
      mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
