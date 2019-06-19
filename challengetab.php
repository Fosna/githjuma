<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style/challengetab.style.css">
<!-- Dobivanje challenga iz baze -->
<?php
    require 'scr/dbh.scr.php';
    $sql = "SELECT * FROM hjuma_challenges;";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
?>
<!-- Dobivanje challenga iz baze -->
<!-- Card - prikazivanje challenga -->

<div id="card"  class="card text-center">
    <div class="card-header">
        <?php echo $row['challenge_difficulty']; ?>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $row['challenge_title']; ?></h5>
        <p class="card-text">
<?php   
        #stavlja tri točke samo ako je broj slova veci od 43
        $char_number = strlen($row['challenge_description']);
        if ($char_number > 43) {
            echo substr($row['challenge_description'],0,43), "..."; 
        }else{
            echo substr($row['challenge_description'],0,43); 
        }    
?>      
        </p>
        <!-- Form koji salje na stranicu koja opisuje challenge -->
        <form name="form" action="more_challenge.php" method="post">
        <input type="hidden" name="challenge_id" value="<?php echo $row['challenge_id']; ?>"/>
        <button type="submit" id="seemorebtn" name="seemore-submit" class="btn btn-outline-info" style="width:25%;">More</button>
        </form>
        <!-- Form koji salje na stranicu koja opisuje challenge -->
    </div>
    <div class="card-footer text-muted">
        <?php echo $row['challenge_prog_language']; ?>
    </div>
</div>

<!-- Card - prikazivanje challenga -->
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php
            }
        }
    }
?>
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
