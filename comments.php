<?php require 'header.php';?>
<link rel="stylesheet" href="style/posttab.style.css">
<?php
  require 'scr/dbh.scr.php';
  $postname = mysqli_real_escape_string($conn, $_POST['postname']);
  $grouppost = $_SESSION['groupname'];
  $sql = "SELECT * FROM hjuma_posts WHERE title = '$postname'";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
?>
          <div class="containerpost">
            <h2 class="title"><?php echo  $row['title']; ?></h2>
            <h6 class="description"><?php echo $row['description']; ?></h6>
            <?php
              if($row['image'] != ""){
                echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
              }
            ?>
            <!-- ak smo mi naprtavili post mi ga samo mozemo izbrisat -->
            <!-- <div class="more"> -->
            <!-- <button onclick="more()" class="morebtn">...</button> -->
                <!-- <form action="scr/leavegroup.scr.php" method="post"> -->
                  <!-- <input type="hidden" name="groupname" value="<?php //echo $row['name'];?>" /> -->
                  <!-- <input type="hidden" name="membercount" value="-1" /> -->
                  <!-- <button class="dropbtns" type="submit" name="leavegroup-submit">Delete</button> -->
                <!-- </form> -->
              <!-- </div> -->

          </div>
          <div class="comment">
            <form class="" action="scr/comments.scr.php" method="post">
              <input name="comment" placeholder="Type comment here..." value="" />
              <button class="commentbtn" type="submit" name="comment-submit">Comment</button>
            </form>
          </div>
<?php
          $sql1 = "SELECT * FROM hjuma_comments WHERE post = '$postname'";
          if($result1 = mysqli_query($conn, $sql1)){
            if(mysqli_num_rows($result1) > 0){
                while($row1 = mysqli_fetch_array($result1)){
?>
                    <div class="comments-container">
                        <h3 class="commenter"><?php echo $row1['commenter']; ?></h3>
                        <h2 class="comment"><?php echo $row1['comment']; ?></h2>
                        <h4 class="commenter"><?php echo $row1['date_time']; ?></h4>
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
