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
$sql = "SELECT * FROM hjuma_groups WHERE name=? AND owner = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)){
  echo "SQL error";
}else {
  mysqli_stmt_bind_param($stmt, "ss", $groupname, $user);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
      while($row = mysqli_fetch_array($result)){
        ?>
        <h1 class="title">Settings of <?php echo $groupname; ?></h1>
        <div class="userBox">
        <?php
        $sql1 = "SELECT * FROM hjuma_users WHERE group1 = ? OR group2 = ? OR group3 = ? OR group4 =? OR group5 = ? ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql1)){
          echo "SQL error";
        }else {
          mysqli_stmt_bind_param($stmt, "sssss", $groupname, $groupname, $groupname, $groupname, $groupname);
          mysqli_stmt_execute($stmt);
          $result1 = mysqli_stmt_get_result($stmt);
              while($row1 = mysqli_fetch_array($result1)){?>
                <div class="users">
                  <form class="" action="profile" method="post">
                    <button type="submit" class="username" name="button"><?php echo $row1['username']; ?></button>
                    <input type="hidden"  name="username" value="<?php echo $row1['username']  ?>">
                    </form>
                    <?php if($row1['username'] == $_SESSION['username']){}else { ?>
                      <form class="" action="scr/kickmember.scr.php" method="post">
                        <button style="float: right;" type="submit" class="btn btn-danger" id="kickbtn" name="kick-submit">Kick</button>
                        <input type="hidden"  name="username" value="<?php echo $row1['username']  ?>">
                        <input type="hidden"  name="groupname" value="<?php echo $groupname  ?>">
                      </form>
                    <?php } ?>
                </div>
              <?php
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
  } ?>
