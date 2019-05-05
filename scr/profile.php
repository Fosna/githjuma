<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/account.style.css">
    <div class="namecontainer">
      <?php
        require 'scr/dbh.scr.php';
        $user = mysqli_real_escape_string($conn, $_POST['username']);

      ?>
      <h1 id="username"><?php echo $user; ?></h1>
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


<?php     $username = $_SESSION['username'];
          $sql2 = "SELECT * FROM hjuma_users WHERE username = '$username';";
          if($result2 = mysqli_query($conn, $sql2)){
           if(mysqli_num_rows($result2) > 0){
               while($row2 = mysqli_fetch_array($result2)){
                 $group1 = $row2['group1'];
                 $group2 = $row2['group2'];
                 $group3 = $row2['group3'];
                 $group4 = $row2['group4'];
                 $group5 = $row2['group5'];
               }
             }
           }
           ?>



    </div>

    <?php
      require 'scr/dbh.scr.php';
      $owner = $_SESSION["username"];
      $sql1 = "SELECT * FROM hjuma_groups WHERE owner='$user';";
      if($result1 = mysqli_query($conn, $sql1)){
        if(mysqli_num_rows($result1) > 0){
            while($row1 = mysqli_fetch_array($result1)){
    ?>
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"><?php echo $row1['name'];?></h4>
                  <h5 class="card-text"><?php echo $row1['category']; ?></h5>
              </div>
              <div class="card-body">
                <p class="card-text float-right"><?php echo $row['membercount']; echo"/"; echo $row1['maxmembers']; ?></p>
                  <p class="card-subtitle mb-2 text-muted"><?php echo substr($row1['description'],0,90); ?></p>
                  <?php if($row1['avatar'] != ""){
                    echo '<img class="card-img-top" alt="Card image cap" src="data:image/jpeg;base64,'.base64_encode( $row1['avatar'] ).'"/>';
                  } ?>
                  <?php if (($row1['name'] == $group1) || ($row1['name'] == $group2) || ($row1['name'] == $group3) || ($row1['name'] == $group4) || ($row1['name'] == $group5)) {
?>
                    <form action="scr/entergroup.scr.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                      <button class="btn btn-secondary btn-sm float-left " type="submit" name="entergroup-submit">ENTER</button>
                    </form>
                    <form  action="aboutgroup.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                      <input type="hidden" name="membercount" value="1" />

                      <button class="btn btn-link" type="submit" name="button">About group</button>
                    </form>
                    <form class="ml-auto" action="scr/leavegroup.scr.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                      <input type="hidden" name="membercount" value="-1" />
                      <button class="btn btn-outline-danger btn-sm float-right " type="submit" name="leavegroup-submit">Leave group</button>
                    </form>
<?php
                  }
                  else{
                    if ($row['privacy']=='public') {
?>
                    <form action="scr/joingroup.scr.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                      <input type="hidden" name="membercount" value="1" />
                      <button class="btn btn-primary" type="submit" name="joingroup-submit">JOIN</button>
                    </form>
                    <form  action="aboutgroup.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                      <input type="hidden" name="membercount" value="1" />
                      <button class="btn btn-link " type="submit" name="button">About group</button>
                    </form>
<?php                   }
                  }


?>
              </div>
              </div>
    <?php
            }
          }
        }

    ?>




<?php require 'footer.php'; ?>
