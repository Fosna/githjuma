<link rel="stylesheet" href="style/posttab.style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
  require 'scr/dbh.scr.php';
  $user = $_SESSION['username'];
  $groupname = $_SESSION['groupname'];
  $sql = "SELECT * FROM hjuma_posts WHERE grouppost = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
  }else {
    mysqli_stmt_bind_param($stmt, "s", $groupname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
          $sql1 = "SELECT * FROM hjuma_groups WHERE name = ?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql1)){
            echo "SQL error";
          }else {
            mysqli_stmt_bind_param($stmt, "s", $groupname);
            mysqli_stmt_execute($stmt);
            $result1 = mysqli_stmt_get_result($stmt);
                while($row1 = mysqli_fetch_array($result1)){
                  $groupowner = $row1['owner'];
                }

            }
          $_SESSION['postowner'] = $row['owner'];
          $_SESSION['title'] = $row['title'];
          $postname = $row['title'];
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
              }?>
              <?php if ($row['comments'] !="dont allow"){
                ?>
              <form class="" action="comments" method="post">
                    <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                    <input type="hidden" name="date_time" value="<?php echo $row['date_time'];?>" />
                  <button class="btn btn-primary float-left" type="submit" name="comment-redirect">Comment</button>
              </form>
              <?php
            }
            ?>

            <?php if ($row['owner'] == $_SESSION['username'] ){ ?>
                    <form action="scr/deletepost.scr.php" method="post">
                      <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                      <input type="hidden" name="postowner" value="<?php echo $row['owner']; ?>">
                      <input type="hidden" name="date_time" value="<?php echo $row['date_time']; ?>">
                      <button class="btn btn-danger float-right" type="submit" name="deletepost-submit">Delete</button>
                    </form>
            <?php }
                  else{
                    if ($groupowner == $_SESSION['username']) {?>
                      <form action="scr/deletepost.scr.php" method="post">
                        <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                        <input type="hidden" name="postowner" value="<?php echo $row['owner']; ?>">
                        <input type="hidden" name="date_time" value="<?php echo $row['date_time']; ?>">
                        <button class="btn btn-danger float-right" type="submit" name="deletepost-submit">Delete</button>
                      </form>
                  <?php  }

                    $sql2 = "SELECT * FROM hjuma_likes WHERE post=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql2)){
                      echo "SQL error";
                    }else {
                      mysqli_stmt_bind_param($stmt, "s", $postname);
                      mysqli_stmt_execute($stmt);
                      $result2 = mysqli_stmt_get_result($stmt);
                        while($row2 = mysqli_fetch_assoc($result2)){
                          $liker = $row2['user'];
                          if ($_SESSION['username'] != $liker) {
            ?>
                            <form class="" action="scr/like.scr.php" method="post">
                              <input type="hidden" name="postname" value="<?php echo $row['title'];?>" />
                              <button type="submit" name="like-submit">Like</button>
                            </form>
             <?php
                        }
                      }
                  }
                }
           ?>
          </div>
<?php
                      }
                    }

?>
