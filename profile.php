<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/account.style.css">
    <?php
      require 'scr/dbh.scr.php';
      $user = $_SESSION['sender_name'];
    ?>
    <h1><?php echo $user; ?></h1>
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
