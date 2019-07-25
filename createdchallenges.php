<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challengetab.style.css">
<div class="space"></div>
<h1 style="text-align:center;">Created Challenges</h1>
<hr class="my-3">
<div class="container">
<!-- Dobivanje challenga iz baze -->
<?php
    require 'scr/dbh.scr.php';
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_owner='$user_id';";
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
<!-- Dobivanje challenga iz baze -->
<!-- Card - prikazivanje challenga -->
<form name="form" action="challenge_info?c=<?php echo $row['challenge_id'];?>" method="post">
    <div id="card" class="card text-center <?php echo $card_color; ?>" onclick="this.parentNode.submit()">
        <div class="card-body">
            <h5 class="card-title"><b><?php echo $row['challenge_title']; ?></b></h5>
            <p class="card-text">
<?php
            #stavlja tri točke samo ako je broj slova veci od 43
            $char_number = strlen($row['challenge_explanation']);
            if ($char_number > 114) {
                echo substr($row['challenge_explanation'],0,114), "...";
            }else{
                echo substr($row['challenge_explanation'],0,114);
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
<!-- Card - prikazivanje challenga -->
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php
            }
        }
    }
?>
</div>
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php require 'footer.php' ?>
