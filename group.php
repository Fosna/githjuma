<?php require 'header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/group.style.css">
<form action="createpost" method="post">
  <button class="createpostbtn" type="submit" name="button">Create post</button>
</form>
<?php
    require 'scr/dbh.scr.php';
    $user = $_SESSION["username"];
    if (!isset($_SESSION['id'])) {
      header("Location: main");
    }
    $sql = "SELECT * FROM hjuma_users WHERE username='$user' ";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          $group1 = $row['group1'];
          $group2 = $row['group2'];
          $group3 = $row['group3'];
          $group4 = $row['group4'];
          $group5 = $row['group5'];
        }
      }
    }
    elseif ($_SESSION['groupname'] != $group1 || $_SESSION['groupname'] != $group2 || $_SESSION['groupname'] != $group3 || $_SESSION['groupname'] != $group4 || $_SESSION['groupname'] != $group5 ) {
      header("Location: main");
    }
    else{
    $groupname = $_SESSION['groupname'];
    $sql1 = "SELECT * FROM hjuma_users WHERE username='$user' ";
    if($result1 = mysqli_query($conn, $sql1)){
      if(mysqli_num_rows($result1) > 0){
          while($row1 = mysqli_fetch_array($result1)){
  ?>
         <?php
          if ($row1['group1']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group1'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group1'];?>" />
               <h2 class="name"><?php echo $row['group1']; ?></h2>

             </button>

           </form>
         <?php } ?>

         <?php
          if ($row1['group2']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group2'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group2'];?>" />
               <h2 class="name"><?php echo $row['group2']; ?></h2>

             </button>

           </form>

         <?php } ?>
         <?php
          if ($row1['group3']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group3'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group3'];?>" />
               <h2 class="name"><?php echo $row['group3']; ?></h2>
             </button>
           </form>
         <?php } ?>
         <?php
          if ($row1['group4']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group4'];?>">
               <input type="hidden" name="groupname" value="<?php echo $row['group4'];?>" />
               <h2 class="name"><?php echo $row['group4']; ?></h2>
             </button>
           </form>
         <?php } ?>
         <?php
          if ($row1['group5']!=""){
           ?>
           <form class="" action="scr/entergroup.scr.php" method="post">
             <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group5'];?>">
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
    <?php
    $sql = "SELECT * FROM hjuma_groups WHERE name='$groupname' ";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
            if($row['owner'] == $_SESSION['username']){?>
              <form class="" action="adminsettings.php" method="post">
                <button class="settingsbtn" type="submit" name="button">Settings</button>
              </form>
              <?php
            }
          }
        }
      } ?>
  </body>

</html>
