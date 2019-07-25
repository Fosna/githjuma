<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challengetab.style.css">
<h1 style="text-align:center;">Your results:</h1>
<hr class="my-3">
<div class="container">
<div class="row">
<?php
if (!isset($_POST['search_challenge-submit'])) {
    header("Location: main");
}elseif (isset($_POST['search_challenge-submit'])) {
  require 'scr/dbh.scr.php';
  $search_challenge = mysqli_real_escape_string($conn, $_POST['search_challenge']);
  if ($search_challenge == ""){
    header("Location: main");
  }
  $sql = "SELECT * FROM hjuma_challenges WHERE challenge_title LIKE '%$search_challenge%';";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
          $diff = $row['challenge_difficulty'];
          if ($diff == "Easy") {
            $card_color = "bg-success mb-3";
          }elseif ($diff == "Medium") {
            $card_color = "bg-warning mb-3";
          }elseif ($diff == "Hard") {
            $card_color = "bg-danger mb-3";
          }
?>
<div class="col-sm-3">
            <form name="form" action="challenge_info?c=<?php echo $row['challenge_id'];?>" method="post">
                <div id="card" class="card text-center <?php echo $card_color; ?>" onclick="this.parentNode.submit()">
                    <div class="card-body">
                        <h5 class="card-title"><b><?php echo $row['challenge_title']; ?></b></h5>
                        <p class="card-text">
<?php
                        #stavlja tri točke samo ako je broj slova veci od 110
                        $char_number = strlen($row['challenge_explanation']);
                        if ($char_number > 110) {
                            echo substr($row['challenge_explanation'],0,110), "...";
                        }else{
                            echo substr($row['challenge_explanation'],0,110);
                        }
?>
                        </p>
                        <!-- Form koji salje na stranicu koja opisuje challenge -->

                        <!-- Form koji salje na stranicu koja opisuje challenge -->
                    </div>
                    <div class="card-footer text-muted">
                        <?php echo $row['challenge_prog_language']; ?>
                    </div>
                </div>
            </form>
</div>
<?php
        }
    }else{
        echo '
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                No Result!
            </div>
        </div>';
    }
  }
}
?>
</div>
</div>
<?php require 'footer.php' ?>
