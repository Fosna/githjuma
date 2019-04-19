<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/profile.style.css">
    <div class="namecontainer">
      <?php
        require 'scr/dbh.scr.php';
        $user = $_SESSION['sender_name'];
      ?>
      <h1 class="username"><?php echo $user; ?></h1>
      <?php
       $sql = "SELECT * FROM hjuma_users WHERE username = '$user';";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
              if($row['profileimage'] == ""){
                ?>
                <div class="icon">
                  <img class="native_profileimage" src="pics/icon.png"/>
                </div>

            <?php         }
            else {?>
              <div class="icon">
              <?php echo '<img class="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row['profileimage'] ).'"/>';  ?>
            </div>

          <?php           }
                        }
                      }
                    }
                ?>





    </div>




    <?php
     $sql = "SELECT * FROM hjuma_groups WHERE owner = '$user';";
    if($result = mysqli_query($conn, $sql)){
      if(mysqli_num_rows($result) > 0){
          while($row = mysqli_fetch_array($result)){
              ?>
              <div class="container">
                <h2 class="name"><?php echo $row['name']; ?></h2>
                <h2 class="category"><?php echo $row['category']; ?></h2>
                <h2 class="description"><?php echo $row['description']; ?></h2>
                <h2 class="maxmembers"><?php echo "x/", $row['maxmembers']; ?></h2>
              </div>
              <?php
                      }
                    }
                  }
              ?>
<?php require 'footer.php'; ?>
