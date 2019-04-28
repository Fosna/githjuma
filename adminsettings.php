<?php require 'header.php' ?>
<link rel="stylesheet" href="style/adminsettings.style.css">
<link rel="stylesheet" href="style/login_signup.style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style media="screen">
  .container{
    margin-top: -210px;
  }
  .btn-success{
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 10px;
    font-size: 30px;
  }
  @media only screen and (max-width: 1369px) {
    .container{
      width: 30rem;
    }

  }
</style>
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
                        <button style="float: right;" type="submit" class="btn btn-danger" id="kickbtn" name="kick-submit">Kick</button>
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
        <div class="container">
          <h1 style="text-align: center;">Upadate group</h1>
          <form class="" action="scr/updategroup.scr.php" method="post">
              <div class="form-group">
            Maxmembers:<input type="number" class="form-control"  name="maxmembers" value="<?php echo $row['maxmembers']; ?>">
          </div>
            <div class="form-group">
            Description: <input type="text" class="form-control" name="description" value="<?php echo $row['description']; ?>">
          </div>
            Privacy: <select class="form-control" id="exampleFormControlSelect1" name="privacy">
              <option  value="public">Public</option>
              <option value="private">Private</option>
            </select>
            <button type="submit" class="btn btn-success" name="updategroup-submit">Update</button>
          </form>

        </div>

<?php
      }
    }
  } ?>
