
<?php require 'scr/dbh.scr.php'; ?>
<?php session_start();
$receiver = $_SESSION['receiver'];
$username = $_SESSION['username'];
?>


<?php
$sql = "SELECT * FROM hjuma_privatemessages WHERE receiver=? AND sender_name=? OR receiver=? AND sender_name=?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  echo "SQL error";
}else {
  mysqli_stmt_bind_param($stmt, "ssss", $receiver, $username, $username, $receiver);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
      while($row = mysqli_fetch_array($result)){
        $sender_name = $row['sender_name'];
        $_SESSION['sender_name']  = $sender_name;
        $message = $row['message'];
        $date = $row['date_time'];
     

        if ($sender_name != $_SESSION['username']){


?>
<div class="alert alert-secondary" id="gray-col">
  <?php $sql2 = "SELECT * FROM hjuma_users WHERE username = ? ";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql2)){
    echo "SQL error";
  }else {
    mysqli_stmt_bind_param($stmt, "s", $sender_name);
    mysqli_stmt_execute($stmt);
    $result2 = mysqli_stmt_get_result($stmt);
        while($row2 = mysqli_fetch_array($result2)){
          if($row2['profileimage'] != ""){
           ?>
          <div class="iconMessageleft">
            <?php echo '<img class="imageMessageleft" src="data:image/jpeg;base64,'.base64_encode( $row2['profileimage'] ).'"/>'; ?>
          </div>
        <?php }
        else {?>
          <div class="iconMessageleft">
          <img class="native_profileimageHeader" onclick="dropdown()" src="pics/icon.png">
          </div>

        <?php  } ?>


  <?php if(strpos($message, 'https') !== false){ ?>
    <a class="messageleft" href="<?php echo $message; ?>"><?php echo $message; ?></a>
  <?php }else{ ?>
    <h1 class= "messageleft"><?php echo $message; ?></h1>
  <?php } ?>
  <h6 style="display: none;" class="dateleft"><?php echo $date; ?><h6>
  <form class="" action="profile" method="post">
    <button type="submit" class="profilebtn_left" name="button"><?php echo $sender_name; ?></button>
    <input type="hidden"  name="username" value="<?php echo $sender_name  ?>">
  </form>
  <?php if($_SESSION['username'] == $sender_name){ ?>
    <form class="" action="scr/deleteprivatemessage.scr.php" method="post">
      <input type="hidden" name="message" value="<?php echo $message; ?>">
      <input type="hidden" name="sender" value="<?php echo $sender_name; ?>">
      <input type="hidden" name="time" value="<?php echo $date; ?>">
      <button class="btn btn-danger" id="deleteleft" type="submit" name="deletemessage-submit">Delete</button>
    </form>
  <?php } ?>
</div>
<?php
      }
  }
  ?>
<?php      }
else{ ?>
  <div class="alert alert-primary" id="white-col">
    <?php $sql1 = "SELECT * FROM hjuma_users WHERE username =? ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql1)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      $result1 = mysqli_stmt_get_result($stmt);
          while($row1 = mysqli_fetch_array($result1)){?>

  <?php if(strpos($message, 'https') !== false){ ?>
    <a class="messageright" href="<?php echo $message; ?>"><?php echo $message; ?></a>
  <?php }else{ ?>
    <h1 class= "messageright"><?php echo $message; ?></h1>
  <?php } ?>
    <h6 class="date" style="display: none;"><?php echo $date; ?><h6>
      <?php if($_SESSION['username'] == $sender_name){ ?>
        <form class="" action="scr/deleteprivatemessage.scr.php" method="post">
          <input type="hidden" name="message" value="<?php echo $message; ?>">
          <input type="hidden" name="sender" value="<?php echo $sender_name; ?>">
          <input type="hidden" name="time" value="<?php echo $date; ?>">
          <button class="btn btn-danger" id="deleteright" type="submit" name="deletemessage-submit">Delete</button>
        </form>
      <?php } ?>
  </div>
  <?php
        }
      }
   ?>

<?php
            }
          }
        }

?>
<script type="text/javascript">
var myDiv = document.getElementById("container-message");
myDiv.scrollTop = myDiv.scrollHeight;
</script>
