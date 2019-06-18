<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challenge.style.css">
<div class="space"></div>
<?php 
    $username = $_SESSION['username'];
    $owner = $username;
    require 'scr/dbh.scr.php';
    $sql = "SELECT * FROM hjuma_users WHERE challenge_1='$username';";
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
                if ($challenge_owner === $username){

                
?>
               <div id="card"  class="card text-center">
                    <div class="card-header">
                        <?php echo $row['challenge_difficulty']; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['challenge_title']; ?></h5>
                        <p class="card-text"><?php echo substr($row['challenge_description'],0,75), "..."; ?></p>
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
<?php
                }
            }
        }
    }
?>
</body>
</html>