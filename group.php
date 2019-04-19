<?php require 'header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/group.style.css">
<form action="createpost" method="post">
  <button class="createpostbtn" type="submit" name="button">Create post</button>
</form>
<?php
      if (!isset($_SESSION['id'])) {
        header("Location: main");
      }else{
      require 'scr/dbh.scr.php';
      $user = $_SESSION["username"];
      $sql = "SELECT * FROM hjuma_users WHERE username='$user' ";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
    ?>
           <?php
            if ($row['group1']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group1'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group1'];?>" />
                 <h2 class="name"><?php echo $row['group1']; ?></h2>

               </button>

             </form>
           <?php } ?>

           <?php
            if ($row['group2']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group2'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group2'];?>" />
                 <h2 class="name"><?php echo $row['group2']; ?></h2>

               </button>

             </form>

           <?php } ?>
           <?php
            if ($row['group3']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group3'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group3'];?>" />
                 <h2 class="name"><?php echo $row['group3']; ?></h2>

               </button>

             </form>
           <?php } ?>
           <?php
            if ($row['group4']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group4'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group4'];?>" />
                 <h2 class="name"><?php echo $row['group4']; ?></h2>

               </button>

             </form>
           <?php } ?>
           <?php
            if ($row['group5']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit" id="container-side" class="container-side" value="<?php echo $row['group5'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group5'];?>" />
                 <h2 class="name"><?php echo $row['group5']; ?></h2>

               </button>

             </form>
           <?php } ?>

             <?php
                }
              }
            }
          }
      ?>


<?php require 'posttab.php'; ?>
<?php require 'groupmessage.php'; ?>
  </body>
</html>
