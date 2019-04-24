<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/account.style.css">

    <div class="namecontainer">
      <?php
          if (isset($_SESSION['username'])) {
            echo '<div id="username">'.$_SESSION['username'].'</div>';


          }
      ?>



        <form class="" style="margin-top:40px;" action="scr/passwordconfirm.scr.php" method="post">
          Confrim password: <input type="password" name="password" autocomplete="off" placeholder="Lozinka" value="" required>
          <button type="submit" class="submit" name="passwordconfirm-submit">Change name</button>
        </form>



      <?php
        require 'scr/dbh.scr.php';
        $owner = $_SESSION["username"];
        $sql = "SELECT * FROM hjuma_users WHERE username='$owner';";
        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){

                if($row['profileimage']==""){
      ?>
      <div class="icon">
        <img class="native_profileimage" src="pics/icon.png"/>
      </div>


      <?php     }
      else {?>

        <div class="icon">
          <?php echo '<img class="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row['profileimage'] ).'"/>';  ?>

        </div>

        <?php
                }
                echo '<div class="email">'.$row['email'].'</div>';
              }
            }
          }
      ?>


      <div class="imageupload">
        <form class="" action="scr/accountupdate.scr.php" method="post" enctype="multipart/form-data">
            <input type="file" class="file" name="avatar" value="">
        <button type="submit" class="uploadfile" name="accountupdate-submit">Upload</button>

        </form>
      </div>



    </div>



    <?php
      require 'scr/dbh.scr.php';
      $owner = $_SESSION["username"];
      $sql = "SELECT * FROM hjuma_groups WHERE owner='$owner';";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
    ?>
              <div class="container">
                <h2 class="name"><?php echo $row['name']; ?></h2>
                <h2 class="category"><?php echo $row['category']; ?></h2>
                <h2 class="description"><?php echo $row['description']; ?></h2>
                <h2 class="maxmembers"><?php echo $row['membercount'],"/", $row['maxmembers']; ?></h2>
                <form class="" action="scr/deletegroup.scr.php" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                  <button type="submit" class="join" name="deletegroup-submit">Delete</button>
                </form>
              </div>
    <?php
            }
          }
        }
    ?>


<?php require 'footer.php'; ?>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
