<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="style/challengetab.style.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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

<div class="card text-center">
<div class="card-header">
    <?php echo $row['challenge_difficulty']; ?>
</div>
<div class="card-body">
    <h5 class="card-title"><?php echo $row['challenge_title']; ?></h5>
    <p class="card-text"><?php echo $row['challenge_description']; ?></p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
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