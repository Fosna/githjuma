<link rel="stylesheet" href="style/grouptab.style.css">

<?php
  require 'scr/dbh.scr.php';
  $owner = $_SESSION['username'];
  $sql = "SELECT * FROM hjuma_groups";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $id = $row['name'];
?>
            <div class="container" >
              <h2 class="owner" style="display: none;"><?php echo  $row['owner']; ?></h2>
              <h2 class="name"><?php echo $row['name'];?></h2>
              <h2 class="category"><?php echo $row['category']; ?></h2>
              <h2 class="description"><?php echo $row['description']; ?></h2>
              <h2 class="maxmembers"><?php echo $row['membercount']; echo"/"; echo $row['maxmembers']; ?></h2>
<?php
            if($row['avatar'] != ""){
              echo '<img class="avatar" src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>';
            }
?>
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
                          <button class="join" type="submit" name="entergroup-submit">ENTER</button>
                        </form>
                        <form action="scr/leavegroup.scr.php" method="post">
                          <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                          <input type="hidden" name="membercount" value="-1" />
                          <button class="dropbtn" type="submit" name="leavegroup-submit">Leave group</button>
                        </form>

<?php
                      }
                      else{
?>
                        <form action="scr/joingroup.scr.php" method="post">
                          <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                          <input type="hidden" name="membercount" value="1" />
                          <button class="join"  type="submit" name="joingroup-submit">JOIN</button>
                        </form>
<?php
                      }
                    }
                  }
                }
?>
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
