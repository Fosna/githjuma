<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php require 'header.php'; ?>
    <div class="space">

    </div>
    <link rel="stylesheet" href="style/aboutgroup.style.css">
    <title></title>
  </head>
  <body>
    <?php
    require 'scr/dbh.scr.php';
    session_start();
    $groupname = mysqli_real_escape_string($conn, $_POST['groupname']);
    $membercount = mysqli_real_escape_string($conn, $_POST['membercount']);
      ?>
      <h1><?php echo $groupname; ?></h1>
      <?php
      $sql = "SELECT * FROM hjuma_groups WHERE name = '$groupname'";
      session_start();
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
              ?>
              <h4 class="members"><?php echo $row['membercount'],"/",$row['maxmembers']; ?></h4>
              <h6><?php echo $row['owner']; ?></h6>
              <h3><?php echo $row['description']; ?></h3>

              <?php echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>'; ?>
              <hr>
            <?php
            }
           }
          }
?>
<div class="userBox">
  <h1 class = "aboveUsers">Users</h1>
  <?php
  $sql1 = "SELECT * FROM hjuma_users WHERE group1 = '$groupname' OR group2 = '$groupname' OR group3 = '$groupname' OR group4 = '$groupname' OR group5 = '$groupname'";
  session_start();
  if($result1 = mysqli_query($conn, $sql1)){
    if(mysqli_num_rows($result1) > 0){
        while($row1 = mysqli_fetch_array($result1)){
          ?>

          <div class="users">
            <h2 class="username"><?php echo $row1['username'] ?></h2>
            <h2 class="online">online</h2>

          </div>
        <?php
       }
      }
     }
     ?>
</div>

  </body>
</html>
