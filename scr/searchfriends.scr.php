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
                      $searchuser = $row['username'];
                    $sql1 = "SELECT * FROM hjuma_friends WHERE user1=? OR user2=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql1)){
                      echo "SQL error";
                    }else {
                      mysqli_stmt_bind_param($stmt, "ss",  $searchuser,  $searchuser);
                      mysqli_stmt_execute($stmt);
                      $result1 = mysqli_stmt_get_result($stmt);
                          while($row1= mysqli_fetch_array($result1)){
                              if($row['username']==$row1['user1']){
                                  $userfriend = $row1['user2'];
                              }else{
                                  $userfriend = $row1['user1'];
                              }
                           
                            }
                        }
                            ?>
                      

                        <div class="searchresult1">
                          <form class="" action="scr/sendfriendreq.scr.php" method="post">
                            <p class="username"><?php echo $row['username']; ?></p>
                            <?php if($row['username'] == $_SESSION['username'] || $userfriend == $_SESSION['username']){ ?>
                            <?php }else{ ?>
                                <button style="float: right;" type="submit" class="btn btn-success" id="invitebtn" name="inviteuser-submit">Make friend!</button>
                            <?php } ?>
                            <input type="hidden" name="sender" value="<?php echo $_SESSION['username']; ?>">
                            <input type="hidden"  name="receiver" value="<?php echo $row['username']  ?>">
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
