<link rel="stylesheet" href="style/group.style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<?php
  if (!isset($_SESSION['id'])) {
    header("Location: main");
  }else{
  require 'scr/dbh.scr.php';
  $user = $_SESSION["username"];
  $sql = "SELECT * FROM hjuma_users WHERE username=? ";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
  }else {
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
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

?>

  <div id="messagebox" class="bottom">
    <input type="button" class="btn btn-light btn-sm" id="show_hidebtn" onclick="toggle_div_fun('container-message','messagebox'); change();" value="▼" name="button"></input>
    <input type="text" id="message" autocomplete="off"  class="messagebox" placeholder="Message" ></input>
    <input class="send" type="submit" id="submit_comment" name="send-submit" value=">"></button>
  </div>
<script src="scr/jquery.js" charset="utf-8"></script>
<script type="text/javascript">
var input = document.getElementById("message");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("submit_comment").click();
  }
});
  $(document).ready(function() {
    // alert("jquery working");

    $("#submit_comment").click(function(){
       var message = $("#message").val();

       $.ajax({
         url: "scr/message.scr.php",
         type: "POST",
         async: false,
         data: {
           "data":1,
           "message" : message,
         },
         success: function(data){
           $("#message").val('');
         }
       })
    });
  });
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
  }, 305);
});
</script>
  </body>
</html>
