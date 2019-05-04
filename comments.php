<?php require 'header.php';?>
<link rel="stylesheet" href="style/comments.style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php
  require 'scr/dbh.scr.php';
  if (isset($_POST['comment-redirect'])) {
    $postname = mysqli_real_escape_string($conn, $_POST['postname']);
    $date_time = mysqli_real_escape_string($conn, $_POST['date_time']);
  }else {
    $postname = $_SESSION['postname'];
  }
  $sql = "SELECT * FROM hjuma_posts WHERE title = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
  }else {
    mysqli_stmt_bind_param($stmt, "s", $postname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
?>
<div class="card">
  <h2 class="postowner" style="display: none;" ><?php echo  $_SESSION['postowner'];?></h2>
  <div class="card-header">
  <h4 class="card-title" ><?php echo  $row['title']; ?></h4>
  </div>
  <div class="card-body">
  <p class="card-subtitle mb-2 text-muted"><?php echo $row['description']; ?></p>
</div>
            <?php
              if($row['image'] != ""){
                echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';
              }
            ?>
          </div>
          <br>
          <div class="form-group">
            <form class="" action="scr/comments.scr.php" method="post">
              <input type="hidden" name="postname" value="<?php echo $row['title'];?>"/>
              <input class="form-control" id="commentinput" name="comment" autocomplete="off" placeholder="Type comment here..." value="" />
              <button class="commentbtn" type="submit" name="comment-submit">Comment</button>
            </form>
          </div>
          <br>
          <div class="rightside">

<?php
          $groupname = $_SESSION['groupname'];
          $sql1 = "SELECT * FROM hjuma_comments WHERE grouppost = ? AND post = ?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql1)){
            echo "SQL error";
          }else {
            mysqli_stmt_bind_param($stmt, "ss", $groupname, $postname);
            mysqli_stmt_execute($stmt);
            $result1 = mysqli_stmt_get_result($stmt);
                while($row1 = mysqli_fetch_array($result1)){
?>
                    <div  id="comments-container">
                      <form class="" action="profile" method="post">
                        <input type="hidden" name="username" value="<?php echo $row1['commenter']; ?>">
                        <button type="submit" class="commenter" name="button"><?php echo $row1['commenter']; ?></button>
                      </form>

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
?>

</div>
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
