<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/account.style.css">
    <link rel="stylesheet" href="style/includes/error.inc.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="namecontainer">
      <?php
          if (isset($_SESSION['username'])) {
            echo '<div id="username">'.$_SESSION['username'].'</div>';
          }
      ?>
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
      <div class="form-group">
        <form class="" style="margin-top:40px;" action="scr/passwordconfirm.scr.php" method="post">
          <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Confirm password to change name" value="" required>
          <button type="submit" class="btn btn-success" name="passwordconfirm-submit">Change name</button>
        </form>
      </div>

      <div class="imageupload">
        <form class="" action="scr/accountupdate.scr.php" method="post" enctype="multipart/form-data">
          <input class="btn btn-primary" id="file" style="display: none;"  type="file" name="avatar" value="">
          <input type="button" value="Choose image" class="btn btn-primary" id="file_alt"></input>
        <button type="submit" class="btn btn-primary" name="accountupdate-submit">Upload</button>

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
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"><?php echo $row['name'];?></h4>
                  <h5 class="card-text"><?php echo $row['category']; ?></h5>
              </div>
              <div class="card-body">
                <p class="card-text float-right"><?php echo $row['membercount']; echo"/"; echo $row['maxmembers']; ?></p>
                  <p class="card-subtitle mb-2 text-muted"><?php echo substr($row['description'],0,90); ?></p>
                  <?php if($row['avatar'] != ""){
                    echo '<img class="card-img-top" alt="Card image cap" src="data:image/jpeg;base64,'.base64_encode( $row['avatar'] ).'"/>';
                  } ?>
                <form class="" action="scr/deletegroup.scr.php" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                  <button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#exampleModal" >Delete</button>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Do you want to delete this group?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  name="deletegroup-submit" class="btn btn-danger">Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>
              </div>
    <?php
            }
          }
        }
        if (isset($_GET['error'])) {
          $error = $_GET['error'];
          if ($error == "pwd") {
            echo '<div class="error">Password incorrect!</div>';
          }
        }
    ?>

<?php require 'footer.php'; ?>
<script type="text/javascript">
document.getElementById('file_alt').addEventListener('click',function(){
  document.getElementById('file').click();
});

</script>
<script>
var modal = document.getElementById('id01');

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
