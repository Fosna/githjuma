<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/group.style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <form class="" action="post" method="post">
      <button type="submit" name="button">Posts</button>
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
               <button type="submit" name="entergroup-submit" class="container-side" value="<?php echo $row['group1'];?>">
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
               <button type="submit" name="entergroup-submit" class="container-side" value="<?php echo $row['group2'];?>">
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
               <button type="submit" name="entergroup-submit" class="container-side" value="<?php echo $row['group3'];?>">
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
               <button type="submit" name="entergroup-submit" class="container-side" value="<?php echo $row['group4'];?>">
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
               <button type="submit" name="entergroup-submit" class="container-side" value="<?php echo $row['group5'];?>">
                 <input type="hidden" name="groupname" value="<?php echo $row['group5'];?>" />
                 <h2 class="name"><?php echo $row['group5']; ?></h2>

               </button>

             </form>
           <?php } ?>
              <div class="container-message" id="container-message">
                <div class="title">
                </div>
                <div class="left-col">
                  <?php
                    
                  ?>
                </div>
                </div>
    <?php
            }
          }
        }
      }
    ?>
<form class="" action="scr/message.scr.php" method="post">
  <div class="bottom">
    <input type="text" autocomplete="off" name="message" class="messagebox" ></input>

    <input class="send" type="submit" name="send-submit" ></button>
  </div>
</form>
<script src="scr/jquery.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
  setInterval(function(){
    $('#container-message').load('message.php')
  }, 35);
});

</script>
  </body>
</html>
