<?php require 'header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/group.style.css">
<link rel="stylesheet" href="style/body.style.css">
<a class="btn btn-primary" href="createpost">Create post</a>
<?php
require 'scr/dbh.scr.php';
$groupname = $_SESSION['groupname'];
$sql = "SELECT * FROM hjuma_groups WHERE name='$groupname' ";
if($result = mysqli_query($conn, $sql)){
  if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_array($result)){
        if($row['owner'] == $_SESSION['username']){?>
          <a href="adminsettings" class="btn btn-primary">Settings</a>
          <?php
        }
        if ($row['privacy'] == 'private') {?>
          <a href="invitepeople" class="btn btn-primary">Invite Friends!</a>

    <?php    }
      }
    }
  } ?>
<?php
    require 'scr/dbh.scr.php';
    $user = $_SESSION["username"];
    if (!isset($_SESSION['id'])) {
      header("Location: main");
    }
    else{

    $sql = "SELECT * FROM hjuma_users WHERE username='$user' ";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
  ?>
         <?php
          if ($row['group1']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="btn btn-primary" value="<?php echo $row['group1'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group1'];?>" />
               <h2 class="name"><?php echo $row['group1']; ?></h2>

             </button>

           </form>
         <?php } ?>

         <?php
          if ($row['group2']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="btn btn-primary" value="<?php echo $row['group2'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group2'];?>" />
               <h2 class="name"><?php echo $row['group2']; ?></h2>

             </button>

           </form>

         <?php } ?>
         <?php
          if ($row['group3']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="btn btn-primary" value="<?php echo $row['group3'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group3'];?>" />
               <h2 class="name"><?php echo $row['group3']; ?></h2>
             </button>
           </form>
         <?php } ?>
         <?php
          if ($row['group4']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="btn btn-primary" value="<?php echo $row['group4'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group4'];?>" />
               <h2 class="name"><?php echo $row['group4']; ?></h2>
             </button>
           </form>
         <?php } ?>
         <?php
          if ($row['group5']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="btn btn-primary" value="<?php echo $row['group5'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group5'];?>" />
               <h2 class="name"><?php echo $row['group5']; ?></h2>
             </button>
           </form>
         <?php
                }
              }
            }
          }
        }
    ?>


    <?php require 'posttab.php'; ?>
    <?php require 'groupmessage.php'; ?>

  </body>

</html>
