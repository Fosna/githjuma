<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challenge.style.css">
<div class="space"></div>
<?php 
    $username = $_SESSION['username'];
    $owner = $username;
    $challenge_id = $_SESSION['challenge_id'];
    require 'scr/dbh.scr.php';
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_owner='$owner' AND challenge_id='$challenge_id';";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $challenge_id_fetched = $row['challenge_id'];
                $challenge_owner = $row['challenge_owner'];
                $challenge_title = $row['challenge_title'];
                $challenge_type = $row['challenge_type'];
                $challenge_difficulty = $row['challenge_difficulty'];
                $challenge_description = $row['challenge_description'];
                $challenge_prog_language = $row['challenge_prog_language'];
                $challenge_start_date = $row['challenge_start_date'];
                $challenge_deadline = $row['challenge_deadline'];
                $challenge_password = $row['challenge_password'];
?>
                <h1><?php echo $challenge_id_fetched; ?></h1>
<?php
            }
        }
    }
?>
<?php require 'footer.php' ?>