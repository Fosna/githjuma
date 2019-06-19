<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/more_challenge.style.css">
<?php
if (!isset($_POST['seemore-submit'])) {
    exit();
}else{
  require 'scr/dbh.scr.php';
  $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
  $sql = "SELECT * FROM hjuma_challenges WHERE challenge_id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
  }else {
    mysqli_stmt_bind_param($stmt, "s", $challenge_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
?>
  <!-- Glavni opis stranice -->
          <div class="jumbotron"> 
          <div class="container">
          <p class="lead" id="challenge_difficulty"><?php echo $row['challenge_difficulty'];?></p>
              <h1 class="display-4"><?php echo $row['challenge_title']; ?></h1>
              <p class="lead" id="challenge_prog_language"><?php echo $row['challenge_prog_language'];?></p>
              <p class="lead"><?php echo $row['challenge_description'];?></p>
              <hr class=my-4>
              <p><?php echo $row['challenge_explanation']; ?> </p>
          </div>
          </div>
  <!-- Glavni opis stranice -->
  <button type="button" id="seecompetitorsbtn" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    See Competitors
  </button>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Competitors</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          User1
          <br>
          User2
          <br>
          User3
          <br>
          itd
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <button id="joinchallengebtn" class="btn btn-primary">Join Challenge</button>
  <!-- Prograss bar (treba skuzit kak cemo to pratit) -->
          <div id="progress-bar" class="progress">
          <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">Progress (comming soon)</div>
          </div>
  <!-- Prograss bar (treba skuzit kak cemo to pratit) -->

<?php if (!isset($_SESSION['id'])) { ?>
          <div class="alert alert-primary" id="alert" role="alert">
          Log in for more enjoyable experience!
          </div>
<?php   }     
        }
      }
  }
  ?>
<script>
$(function () {
  $('.example-popover').popover({
    container: 'body'
  })
})
</script>
