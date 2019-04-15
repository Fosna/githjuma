<link rel="stylesheet" href="style/posttab.style.css">
<?php
  require 'scr/dbh.scr.php';
  $grouppost = $_SESSION['groupname'];
  $sql = "SELECT * FROM hjuma_posts WHERE grouppost = '$grouppost'";
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
            <form class="" action="commentpost" method="post">
                <button type="submit" name="button">Comment</button>
            </form>
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
<?php
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
