<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">

    <h1>My account</h1>
    <?php
        if (isset($_SESSION['username'])) {
          echo '<div id="username">Username: '.$_SESSION['username'].'</div>';
        }
    ?>

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
                <h2 class="maxmembers"><?php echo "x/", $row['maxmembers']; ?></h2>
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
    <?php
    $sql = "SELECT * FROM hjuma_users WHERE username='$owner';";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){

     ?>
     <?php echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['profileimage'] ).'"/>'; ?>

     <?php
             }
           }
         }
     ?>
    <form class="" action="scr/profileupdate.scr.php" method="post">
    <input type="file" name="avatar" value="">
    <button type="submit" name="profileupdate-submit"></button>

    </form>
<?php require 'footer.php'; ?>
