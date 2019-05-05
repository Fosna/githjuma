<?php
  require 'dbh.scr.php';
  if(isset($_REQUEST["term"])){
      $sql = "SELECT * FROM hjuma_groups WHERE name LIKE ? LIMIT 3";
      if($stmt = mysqli_prepare($conn, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_term);
          $param_term = '%%' . $_REQUEST["term"] . '%%';
          if(mysqli_stmt_execute($stmt)){
              $result = mysqli_stmt_get_result($stmt);
              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
                        <div class="searchresult">
                          <form action="aboutgroup.php" method="post">
                            <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                            <input type="hidden" name="membercount" value="1" />
                            <button class="dropdown-item" type="submit" name="joingroup-submit"><?php echo $row["name"]; ?></button>
                          </form>
<?php
                  echo "</div>";
                  }
              } else{
                  //echo "<p> No match!</p>";
              }
          } else{
              echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
      }
      mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
