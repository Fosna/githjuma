<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/account.style.css">
    <h1>My account</h1>
    <img src="pics/profile.png" class="icon" alt="">
    <?php
   session_start();

    ?>

    <?php
      require 'scr/dbh.scr.php';
      $owner = $_SESSION["username"];
      $sql = "SELECT * FROM groups WHERE owner='$owner';";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
    ?>

                </form>
              </div>
    <?php
            }
          }
        }
    ?>
<?php require 'footer.php'; ?>
