<link rel="stylesheet" href="style/posttab.style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
  require 'scr/dbh.scr.php';
  $user = $_SESSION['username'];
  $groupname = $_SESSION['groupname'];
  $sql = "SELECT * FROM hjuma_posts  WHERE grouppost = '$groupname'";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          session_start();
          $_SESSION['postowner'] = $row['owner'];
          $_SESSION['title'] = $row['title'];
          $postname = $row['title'];
?>
          <div class="containerpost">
            <h2 class="postowner" style="display: none;" ><?php echo  $_SESSION['postowner'];?></h2>

            <h2 class="title"><?php echo  $row['title']; ?></h2>
            <h1 id="descriptionfont" class="description"><?php echo $row['description']; ?></h1>
            <?php if ($row['comments'] =="dont allow") {}
              else{
              ?>
            <form class="" action="comments" method="post">
                  <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                <button class="commentbtn" type="submit" name="comment-redirect">Comment</button>
            </form>
            <?php
          }
              if($row['image'] != ""){
                echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
              }
            ?>

            <?php if ($row['owner'] == $_SESSION['username']){ ?>
                    <form action="scr/deletepost.scr.php" method="post">
                      <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                      <button class="dropbtns" type="submit" name="deletepost-submit">Delete</button>
                    </form>
            <?php }
                  else {
                    $sql1 = "SELECT * FROM hjuma_likes WHERE user='$user' AND post='$postname'";
                    if($result1 = mysqli_query($conn, $sql1)){
                      if(mysqli_num_rows($result1) > 0){
                          while($row1 = mysqli_fetch_array($result1)){
                            $liker = $row1['user'];
                          }
                      }
                    }
                  if ($_SESSION['username'] != $liker) {
            ?>
                      <form class="" action="scr/like.scr.php" method="post">
                        <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                        <button type="submit" name="like-submit">Like</button>
                      </form>
             <?php
                  }
                }
           ?>
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
