<link rel="stylesheet" href="style/invites.style.css">
<?php require 'header.php'; ?>
<?php require 'scr/dbh.scr.php'; ?>
<div class="space">

</div>
<div class="inviteBox">
  <?php
  $user = $_SESSION['username'];
  $sql = "SELECT * FROM hjuma_groupinvites WHERE invited_user = ? ";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
  }else { 
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
          $sql1 = "SELECT * FROM hjuma_users WHERE username = ? ";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql1)){
            echo "SQL error";
          }else {
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $result1 = mysqli_stmt_get_result($stmt);
                while($row1 = mysqli_fetch_array($result1)){
                  if ($row1['group1'] == $row['group_invite'] || $row1['group2'] == $row['group_invite'] || $row1['group3' ]== $row['group_invite'] || $row1['group4']==$row['group_invite']||$row1['group5']==$row['group_invite']) {?>
                    <div class="invites">
                      <h1><?php echo $row['inviter']; ?> invited you to <?php echo $row['group_invite']; ?></h1>
                    <button type="button" class="btn btn-success" id="join" name="button">JOINED</button>
                    </div>
                <?php  }else{?>
                  <div class="invites">
                    <h1 id="text"><?php echo $row['inviter']; ?> invited you to <?php echo $row['group_invite']; ?></h1>
                    <form action="scr/joingroup.scr.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $row['group_invite'];?>" />
                      <input type="hidden" name="membercount" value="1" />
                      <button class="btn btn-primary" id="join"  type="submit" name="joingroup-submit">JOIN</button>
                    </form>
                  </div>
                <?php
              }
                }

            }


           ?>


<?php        }

      }

   ?>

</div>
