<link rel="stylesheet" href="style/invites.style.css">
<?php require 'header.php'; ?>
<?php require 'scr/dbh.scr.php'; ?>
<div class="space">

</div>
<div class="inviteBox">
  <?php
  $user = $_SESSION['username'];
  $sql = "SELECT * FROM hjuma_groupinvites WHERE invited_user = '$user' ";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){ ?>
          <div class="invites">
            <h1><?php echo $row['inviter']; ?> invited you to <?php echo $row['group_invite']; ?></h1>
            <form action="scr/joingroup.scr.php" method="post">
              <input type="hidden" name="groupname" value="<?php echo $row['group_invite'];?>" />
              <input type="hidden" name="membercount" value="1" />
              <button class="join"  type="submit" name="joingroup-submit">JOIN</button>
            </form>
          </div>

<?php        }
      }
    } ?>

</div>
