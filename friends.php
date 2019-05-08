<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/invitepeople.style.css">
<div class="space"></div>
<style>
.yourfriends{
  height: 100%;
  width: 100px;
  margin: 20px; 
  border-radius: 20px;
}
</style>
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
        if($row1['user1']!=$username){
          $friend = $row1['user1'];
        }else{
          $friend = $row1['user2'];
        }
        ?>
        <div class="yourfriends">
          <form class="" action="profile" method="post">       
              <input type="hidden" name="sender" value="<?php echo $friend; ?>">
              <button type="submit" style=" float: left; clear: both; font-size: 20px;" class="btn btn-link" id="owner" name="button"><?php echo $friend; ?></button>          
            </form> 
            </div>
    <?php
      }
    }
    $sql2 = "SELECT * FROM hjuma_users WHERE username=? ;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql2)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $friend);
      mysqli_stmt_execute($stmt);
      $result2 = mysqli_stmt_get_result($stmt);
          while($row2= mysqli_fetch_assoc($result2)){
            if($row2['profileimage']!=""){
            echo '<img class="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row2['profileimage'] ).'"/>';
            }else{
              echo "Aaaaaaaaaa";
            }
          }
        }
  ?>