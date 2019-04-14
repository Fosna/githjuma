<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/group.style.css">
<link rel="stylesheet" href="style/posts.style.css">
<form class="" action="createpost" method="post">
  <button class="createpost" type="submit" name="button">Create post</button>
</form>
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
              <?php echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>'; ?>
              <form class="" action="commentpost" method="post">
                  <button type="submit" name="button">Comment</button>
              </form>

            </div>



<?php
        }
      }
    }
?>


<?php require 'groupmessage.php'; ?>
  </body>
</html>
