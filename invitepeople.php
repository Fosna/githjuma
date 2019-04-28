<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/invitepeople.style.css">
<div class="space"></div>
<h1 class="title">Invite people to <?php echo $_SESSION['groupname'] ?></h1>

<div class="userBox">
  <h1 style="margin-top:-50px; text-align: center;">Users</h1>
<?php
require 'scr/dbh.scr.php';

$sql = "SELECT * FROM hjuma_users";
session_start();
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
        $groupname = $_SESSION['groupname'];


        ?>
        <div class="users">
          <form class="" action="profile" method="post">
            <button type="submit" class="username" name="button"><?php echo $row['username']; ?></button>
            <input type="hidden"  name="username" value="<?php echo $row['username']  ?>">
            </form>
            <?php if($row['group1'] != $groupname && $row['group2'] != $groupname && $row['group3'] != $groupname && $row['group4'] != $groupname && $row['group5'] != $groupname){ ?>

              <form class="" action="scr/inviteuser.scr.php" method="post">
                <button style="float: right;" type="submit" class="btn btn-danger" id="invitebtn" name="inviteuser-submit">Invite</button>
                <input type="hidden"  name="invited_user" value="<?php echo $row['username']  ?>">
                <input type="hidden" name="inviter" value="<?php echo $_SESSION['username']; ?>">
                <input type="hidden"  name="groupname" value="<?php echo $groupname;?>">
              </form>
        <?php
       }else {  ?>
            <button style="float: right;" type="submit" class="btn btn-success" id="invitebtn" name="inviteuser-submit">Joined</button>
            <?php
            } ?>
        </div>
      <?php

     }
    }
   }
   ?>
</div>
