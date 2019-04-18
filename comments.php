<?php require 'header.php';?>
<link rel="stylesheet" href="style/comments.style.css">
<?php
  require 'scr/dbh.scr.php';
  if (isset($_POST['comment-redirect'])) {
    $postname = mysqli_real_escape_string($conn, $_POST['postname']);
  }else {
    $postname = $_SESSION['postname'];
  }
  $sql = "SELECT * FROM hjuma_posts WHERE title = '$postname';";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
?>
          <div class="containerpost">
            <h2 class="postowner"><?php echo  $row['owner'];?></h2>
            <h2 class="title"><?php echo  $row['title']; ?></h2>
            <h6 class="description"><?php echo $row['description']; ?></h6>
            <?php
              if($row['image'] != ""){
                echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
              }
            ?>
          </div>
          <br>
          <div class="commentbox">
            <form class="" action="scr/comments.scr.php" method="post">
              <input type="hidden" name="postname" value="<?php echo $row['title'];?>"/>
              <input class="commentinput" name="comment" autocomplete="off" placeholder="Type comment here..." value="" />
              <button class="commentbtn" type="submit" name="comment-submit">Comment</button>
            </form>
          </div>
          <br>
<?php
          $groupname = $_SESSION['groupname'];
          $sql1 = "SELECT * FROM hjuma_comments WHERE grouppost = '$groupname' AND post = '$postname'";
          if($result1 = mysqli_query($conn, $sql1)){
            if(mysqli_num_rows($result1) > 0){
                while($row1 = mysqli_fetch_array($result1)){
?>
                    <div class="comments-container">
                        <h2 class="commenter"><?php echo $row1['commenter']; ?></h2>
                        <h4 class="comment"><?php echo $row1['comment']; ?></h4>
                        <h6 class="time"><?php echo $row1['date_time']; ?></h6>
                        <?php if ($row1['commenter'] == $_SESSION['username']){ ?>
                          <div class="more">
                          <button onclick="more()" class="morebtn" style="display:none;">...</button>
                              <form action="scr/deletecomment.scr.php" method="post">
                                <input type="hidden" name="commenter" value="<?php echo $row1['commenter'];?>" />
                                <input type="hidden" name="date_time" value="<?php echo $row1['date_time'];?>" />
                                <button style="display:none;" class="dropbtns" type="submit" name="deletecomment-submit">Delete</button>
                              </form>
                            </div>
                        <?php } ?>
                    </div>
<?php
                }
            }
          }
        }
      }
    }
?>
<script type="text/javascript">
function more() {
document.getElementById("more-dropdown").classList.toggle("show");
}
window.onclick = function(event) {
if (!event.target.matches('.morebtn')) {
  var dropdowns = document.getElementsByClassName("more-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
    var openDropdown = dropdowns[i];
    if (openDropdown.classList.contains('show')) {
      openDropdown.classList.remove('show');
    }
  }
}
}
</script>
<?php require 'footer.php'; ?>
