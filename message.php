<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php require 'scr/dbh.scr.php'; ?>
    <?php session_start();
    $groupmes = $_SESSION['groupname'];
    ?>
    <?php
    $sql = "SELECT * FROM hjuma_messages WHERE groupmes='$groupmes'";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            $sender_name = $row['sender_name'];
            $_SESSION['sender_name']  = $sender_name;
            $message = $row['message'];
            $date = $row['date_time'];
            $username = $_SESSION['username'];

            if ($sender_name != $_SESSION['username']){


  ?>
    <div class="gray-col">
      <?php $sql2 = "SELECT * FROM hjuma_users WHERE username = '$sender_name' ";
      if($result2 = mysqli_query($conn, $sql2)){
        if(mysqli_num_rows($result2) > 0){
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

      <h1 class= "messageleft"><?php echo $message; ?></h1>
      <h6 class="dateleft"><?php echo $date; ?><h6>
      <form class="" action="profile" method="post">
        <button type="submit" class="profilebtn_left" name="button"><?php echo $sender_name; ?></button>
        <input type="hidden"  name="username" value="<?php echo $sender_name  ?>">
      </form>
    </div>
    <?php
          }
        }
      } ?>
  <?php      }
  else{ ?>
    <div class="white-col">
      <?php $sql1 = "SELECT * FROM hjuma_users WHERE username ='$username' ";
      if($result1 = mysqli_query($conn, $sql1)){
        if(mysqli_num_rows($result1) > 0){
            while($row1 = mysqli_fetch_array($result1)){
              if($row1['profileimage'] != ""){ ?>

      <div class="iconMessage">
        <?php echo '<img class="imageMessage" src="data:image/jpeg;base64,'.base64_encode( $row1['profileimage'] ).'"/>'; ?>
      </div>
    <?php }
    else{ ?>
      <div class="iconMessage">
      <img class="native_profileimageHeader" onclick="dropdown()" src="pics/icon.png">
      </div>
    <?php } ?>
      <h1 class= "messageright"><?php echo $message; ?></h1>
      <h6 class="date"><?php echo $date; ?><h6>
      <form class="" action="account" method="post">
        <button type="submit" class="profilebtn_right" name="button"><?php echo $_SESSION['username']; ?></button>
      </form>
    </div>
    <?php
          }
        }
      } ?>

<?php
              }
            }
          }
        }
?>
  </body>
  <script type="text/javascript">
  var myDiv = document.getElementById("container-message");
  myDiv.scrollTop = myDiv.scrollHeight;
  </script>
</html>
