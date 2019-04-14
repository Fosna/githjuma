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
            if ($sender_name != $_SESSION['username']){

  ?>
    <div class="gray-col">
      <a href="profile" class ="sender"><?php echo $sender_name; ?></a>
      <?php echo $message; ?>
      <h6 class="date"><?php echo $date; ?><h6>
    </div>
  <?php      }
  else{ ?>
    <div class="white-col">
      <a href="account" class ="sender"><?php echo $sender_name; ?></a>
      <?php echo $message; ?>
      <h6 class="date"><?php echo $date; ?><h6>
    </div>

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
