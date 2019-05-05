<?php require 'header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style/mygroups.style.css">
<div class="space">

</div>
<?php
      if (!isset($_SESSION['id'])) {
        header("Location: main");
      }else{
      require 'scr/dbh.scr.php';
      $user = $_SESSION["username"];
      $sql = "SELECT * FROM hjuma_users WHERE username=? ";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL error";
      }else {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_array($result)){
    ?>
           <?php
            if ($row['group1']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit"  class="mygroups" value="<?php echo $row['group1'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group1'];?>" />
                 <h2 class="name"><?php echo $row['group1']; ?></h2>
               </button>
             </form>
             <
           <?php } ?>

           <?php
            if ($row['group2']==""){}
              else {
             ?>
             <form class="" action="scr/entergroup.scr.php" method="post">
               <button type="submit" name="entergroup-submit"  class="mygroups" value="<?php echo $row['group2'];?>">
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
               <button type="submit" name="entergroup-submit" class="mygroups" value="<?php echo $row['group3'];?>">
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
               <button type="submit" name="entergroup-submit" class="mygroups" value="<?php echo $row['group4'];?>">
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
               <button type="submit" name="entergroup-submit" class="mygroups" value="<?php echo $row['group5'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group5'];?>" />
                 <h2 class="name"><?php echo $row['group5']; ?></h2>

               </button>

             </form>
           <?php } ?>

             <?php
                }

            }
          }
      ?>



  </body>
</html>
