<?php require 'header.php'; ?>
<div class="space"></div>
<link rel="stylesheet" href="style/aboutgroup.style.css">
  <?php
  require 'scr/dbh.scr.php';
  session_start();
  $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
  $membercount = mysqli_real_escape_string($conn, $_POST['membercount']);
    ?>
    <h1><?php echo $groupname; ?></h1>
    <?php
    $sql = "SELECT * FROM hjuma_groups WHERE name = '$groupname'";
    session_start();
    $user = $_SESSION['username'];

    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            $owner = $row['owner'];
            ?>
            <h4 class="members"><?php echo $row['membercount'],"/",$row['maxmembers']; ?></h4>
            <h6><?php echo $row['owner']; ?></h6>
            <h3><?php echo $row['description']; ?></h3>

            <?php if ($row['avatar'] != "") {?>
                <?php echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>'; ?>
            <?php }
            $sql2 = "SELECT * FROM hjuma_users WHERE username ='$user'";
            session_start();
            if($result2 = mysqli_query($conn, $sql2)){
              if(mysqli_num_rows($result2) > 0){
                  while($row2 = mysqli_fetch_array($result2)){ ?>
            <hr>
            <?php if($row2['group1']==$groupname  or $row2['group2']==$groupname  or $row2['group3']==$groupname  or $row2['group4']==$groupname or $row2['group5']==$groupname){ ?>
              <form action="scr/entergroup.scr.php" method="post">
                <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                <button class="searchjoin" type="submit" name="entergroup-submit">ENTER</button>
              </form>

          <?php
            }

            elseif($row['owner'] != $_SESSION['username'] or $row2['group1']!=$groupname  or $row2['group2']!=$groupname  or $row2['group3']!=$groupname  or $row2['group4']!=$groupname or $row2['group5']!=$groupname) {?>
              <form action="scr/joingroup.scr.php" method="post">
                <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                <input type="hidden" name="membercount" value="1" />
                <button class="searchjoin" type="submit" name="joingroup-submit">JOIN</button>
              </form>

    <?php         }
                }
              }
            }
          }
         }
        }
?>
<div class="userBox">
  <h1 class = "aboveUsers">Users</h1>
  <?php
  $sql1 = "SELECT * FROM hjuma_users WHERE group1 = '$groupname' OR group2 = '$groupname' OR group3 = '$groupname' OR group4 = '$groupname' OR group5 = '$groupname'";
  session_start();
  if($result1 = mysqli_query($conn, $sql1)){
    if(mysqli_num_rows($result1) > 0){
        while($row1 = mysqli_fetch_array($result1)){

          ?>
          <div class="users">
            <form class="" action="profile" method="post">
              <button type="submit" class="username" name="button"><?php echo $row1['username']; ?></button>
              <input type="hidden"  name="username" value="<?php echo $row1['username']  ?>">
              </form>
              <?php if($owner == $_SESSION['username']){ ?>
                <form class="" action="scr/kickmember.scr.php" method="post">
                  <button style="float: right;" type="submit" name="kick-submit">Kick</button>
                  <input type="hidden"  name="username" value="<?php echo $row1['username']  ?>">
                  <input type="hidden"  name="groupname" value="<?php echo $groupname  ?>">
                </form>
              <?php } ?>


          </div>
        <?php

       }
      }
     }
     ?>
</div>

  </body>
</html>
