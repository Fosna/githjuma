<?php require "header.php"; ?>
<link rel="stylesheet" href="style/login_signup.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<body>
<style>
.container{
    height: 600px;
}
</style>
<h1>Change name</h1>
<?php
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM hjuma_users WHERE username=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL error";
        }else {
          mysqli_stmt_bind_param($stmt, "s", $username);
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
              while($row = mysqli_fetch_array($result)){
                  ?>

  <div class="container">
    <h1 class="newname">Settings</h1>
    <form class="" action="scr/saveaccountsettings.scr.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
      <input class="form-control" type="text" name="newname" value="<?php echo $row['username']; ?>" placeholder="Newname" required>
    </div>
    <div class="form-group">
      <input class="form-control" type="text" name="description" value="<?php echo $row['description']; ?>" placeholder="Say something about you" required>
    </div>
    <div class="imageupload">
          <input class="btn btn-primary" id="file" style="display: none;"  type="file" name="avatar" value="<?php echo '<img class="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row['profileimage'] ).'"/>';?> </input>
          <input type="button" value="Choose image" class="btn btn-primary" id="file_alt"></input>
      </div>
      <button type="button" class="btn btn-success"data-toggle="modal" data-target="#exampleModal" style="display: block; margin-left: auto; margin-right:auto; font-size: 30px;" >Change</button>
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
      Are you sure you want to change name?
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-success"  name="newname-submit">Change</button>
    </div>
  </div>
</div>
</div>
    </form>
    
  </div>
  <?php
              }
            }
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "empty") {
      echo '<div class="error">Fill field!</div>';
    }
    elseif ($error == "usernametaken") {
      echo '<div class="error">Username taken!</div>';
    }
  }
  ?>
</body>
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