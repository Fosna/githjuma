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
<form class=""  action="scr/message.scr.php" method="post" onsubmit="return messageSend();" onsubmit="return formSubmit();">
  <div id="messagebox" class="bottom">
    <input type="button" class="btn btn-light btn-sm" id="show_hidebtn" onclick="toggle_div_fun('container-message','messagebox'); change();" value="▼" name="button"></input>
    <input type="text" autocomplete="off" name="message" class="messagebox" placeholder="Message" ></input>
    <input class="send" type="submit" name="send-submit" value=">"></button>
  </div>
</form>
<script src="scr/jquery.js" charset="utf-8"></script>
<script type="text/javascript">

</script>
<script type="text/javascript">
function toggle_div_fun(id){
  var divelement = document.getElementById(id);

  if(divelement.style.display == 'none')
  divelement.style.display = 'block';
  else
      divelement.style.display = 'none';
}
function change() // no ';' here
{
    var elem = document.getElementById("show_hidebtn");
    if (elem.value=="▼") elem.value = "▲";
    else elem.value = "▼";
}
$(document).ready(function(){
  setInterval(function(){
    $('#container-message').load('message.php')
  }, 505);
});
</script>
  </body>
</html>
