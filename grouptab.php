<link rel="stylesheet" href="style/grouptab.style.css">
<?php
  require 'scr/dbh.scr.php';
  $owner = $_SESSION['username'];
  if ($category == "") {
    $sql = "SELECT * FROM hjuma_groups ORDER BY membercount DESC";
  }else {
    $sql = "SELECT * FROM hjuma_groups WHERE category='$category' ORDER BY membercount DESC";
  }
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['name'];

?>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"><?php echo $row['name'];?></h4>
                <h5 class="card-text"><?php echo $row['category']; ?></h5>
              </div>
              <div class="card-body">
                <p class="card-text float-right"><?php echo $row['membercount']; echo"/"; echo $row['maxmembers']; ?></p>
                <h2 class="owner" style="display: none;"><?php echo  $row['owner']; ?></h2>
                <p class="card-subtitle mb-2 text-muted"><?php echo substr($row['description'],0,90); ?></p>
                <?php if($row['avatar'] != ""){
                  echo '<img class="card-img-top" alt="Card image cap" src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>';
                } ?>
<?php
            $sql2 = "SELECT * FROM hjuma_users WHERE username='$owner'";
            if($result2 = mysqli_query($conn, $sql2)){
              if(mysqli_num_rows($result2) > 0){
                  while($row2 = mysqli_fetch_array($result2)){
                    $sql3 = "SELECT * FROM hjuma_users";
                    if($result3 = mysqli_query($conn, $sql3)){
                      if(mysqli_num_rows($result3) > 0){
                          while($row3 = mysqli_fetch_array($result3)){
                            $group1 = $row3['group1'];
                            $group2 = $row3['group2'];
                            $group3 = $row3['group3'];
                            $group4 = $row3['group4'];
                            $group5 = $row3['group5'];
                          }
                        }
                      }
                      if (($row['name'] == $group1) || ($row['name'] == $group2) || ($row['name'] == $group3) || ($row['name'] == $group4) || ($row['name'] == $group5)) {
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
                    }
                  }
                }

?>
              </div>
            </div>
<?php
        }
      }
    }
?>
<script type="text/javascript">
  function more() {
  document.getElementById("<?php echo $id;?>").classList.toggle("show");
  }
  window.onclick = function(event) {
  if (!event.target.matches('.morebtn')) {
    var dropdowns = document.getElementsByClassName("more-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
  }
</script>
