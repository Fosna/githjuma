<?php require 'header.php' ?>
<link rel="stylesheet" href="style/adminsettings.style.css">
<div class="space">
</div>
<?php
$user = $_SESSION['username'];
$groupname = $_SESSION['groupname'];
$sql = "SELECT * FROM hjuma_groups WHERE name='$groupname' AND owner = '$user'";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
        ?>
        <h1 class="title">Settings of <?php echo $groupname; ?></h1>
        <div class="userBox">
        <?php
        $sql1 = "SELECT * FROM hjuma_users WHERE group1 = '$groupname' OR group2 = '$groupname' OR group3 = '$groupname' OR group4 = '$groupname' OR group5 = '$groupname' ";
        if($result1 = mysqli_query($conn, $sql1)){
          if(mysqli_num_rows($result1) > 0){
              while($row1 = mysqli_fetch_array($result1)){?>
                <div class="users">
                  <form class="" action="profile" method="post">
                    <button type="submit" class="username" name="button"><?php echo $row1['username']; ?></button>
                    <input type="hidden"  name="username" value="<?php echo $row1['username']  ?>">
                    </form>
                      <form class="" action="scr/kickmember.scr.php" method="post">
                        <button style="float: right;" type="submit" class="kickbtn" name="kick-submit">Kick</button>
                        <input type="hidden"  name="username" value="<?php echo $row1['username']  ?>">
                        <input type="hidden"  name="groupname" value="<?php echo $groupname  ?>">
                      </form>
                </div>
              <?php
              }
            }
          }
          ?>
        </div>
        <div class="updateBox">
          <form class="" action="scr/updategroup.scr.php" method="post">
            Max members:<input type="number" name="maxmembers" value="<?php echo $row['maxmembers']; ?>">
            Description: <input type="text" name="description" value="<?php echo $row['description']; ?>">
            Privacy: <select class="select" name="privacy">
              <option  value="public">Public</option>
              <option value="private">Private</option>
            </select>
            <button type="submit" name="updategroup-submit">Update</button>
          </form>

        </div>

<?php
      }
    }
  } ?>
