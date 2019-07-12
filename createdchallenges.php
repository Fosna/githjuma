<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/createdchallenges.style.css">
<link rel="stylesheet" href="style/challengetab.style.css">
<div class="space"></div>
<div class="container" style="margin-top:25px!important;">
<h1 style="margin-left: 35px;">Created Challenges</h1>
<!-- Dobivanje challenga iz baze -->
<?php
    require 'scr/dbh.scr.php';
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_owner='$user_id';";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
?>
<!-- Dobivanje challenga iz baze -->
<!-- Card - prikazivanje challenga -->
<form name="form" action="challenge_info?c=<?php echo $row['challenge_id'];?>" method="post">
    <div id="card" class="card text-center" onclick="this.parentNode.submit()">
        <div class="card-header text-muted">
            <?php echo $row['challenge_difficulty']; ?>
        </div>
        <div class="card-body">
            <h5 class="card-title"><b><?php echo $row['challenge_title']; ?></b></h5>
            <p class="card-text">
<?php   
            #stavlja tri točke samo ako je broj slova veci od 43
            $char_number = strlen($row['challenge_description']);
            if ($char_number > 114) {
                echo substr($row['challenge_description'],0,114), "..."; 
            }else{
                echo substr($row['challenge_description'],0,114); 
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
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
</div>
<?php require 'footer.php' ?>