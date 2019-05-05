<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/invitepeople.style.css">
<div class="space"></div>
<h1  style="margin-top: 100px; margin-left: 55px;">Search friends</h1>
<?php
require 'searchfriends.php';
$username = $_SESSION['username'];
$sql = "SELECT * FROM hjuma_friendrequests WHERE receiver=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  echo "SQL error";
}else {
  mysqli_stmt_bind_param($stmt, "s", $username);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
      while($row = mysqli_fetch_array($result)){?>
      <div class="requests">
          <form action="scr/acceptfriendreq.scr.php" method="post">
          <h1><?php echo $row['sender']?> wants to be your friend!</h1>
          <input type="hidden" name="sender" value="<?php echo $row['sender'];?>" />
          <button class="btn btn-success" type="submit" name="acceptfriend-submit">Accept</button>
          </form>
        </div>
      <?php
      }
    }?>
 <h1 style="float:right; margin-right:20px;">Your friends</h1>
 <?php
 $sql1 = "SELECT * FROM hjuma_friends WHERE user1=? OR user2=?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql1)){
  echo "SQL error";
}else {
  mysqli_stmt_bind_param($stmt, "ss", $username, $username);
  mysqli_stmt_execute($stmt);
  $result1 = mysqli_stmt_get_result($stmt);
      while($row1= mysqli_fetch_array($result1)){
        ?>
          <form class="" action="profile" method="post">
            <?php if($row['user1']!=$username){?>
              <input type="hidden" name="username" value="<?php echo $row1['user1']; ?>">
              <button type="submit" style="float: right; clear: both; font-size: 30px;" class="btn btn-link" id="owner" name="button"><?php echo $row1['user1']; ?></button>
            <?php }else{ ?>
              <input type="hidden" name="username" value="<?php echo $row1['user2']; ?>">
              <button type="submit" style="float: right; clear: both; font-size: 30px;" class="btn btn-link" id="owner" name="button"><?php echo $row1['user2']; ?></button>
            <?php } ?>
            </form> 
    <?php
      }
    }
  ?>