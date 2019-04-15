<link rel="stylesheet" href="style/group.style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<?php
  if (!isset($_SESSION['id'])) {
    header("Location: main");
  }else{
  require 'scr/dbh.scr.php';
  $user = $_SESSION["username"];
  $sql = "SELECT * FROM hjuma_users WHERE username='$user' ";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
?>

       <?php } ?>
            <div class="messagename">
              <h1><?php echo $_SESSION['groupname'];?></h1>
            </div>
            <div class="container-message" id="container-message">
              <div class="title">
              </div>
            <div class="left-col">
              <?php

              ?>
            </div>
            </div>
<?php

      }
    }
  }
?>
<form class="" action="scr/message.scr.php" method="post">
  <div class="bottom">
    <input type="text" autocomplete="off" name="message" class="messagebox" ></input>

    <input class="send" type="submit" name="send-submit" value=">"></button>
  </div>
</form>
<script src="scr/jquery.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
  setInterval(function(){
    $('#container-message').load('message.php')
  }, 305);
});

</script>
  </body>
</html>
