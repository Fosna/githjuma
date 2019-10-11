<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challengetab.style.css">
<div class="space"></div>
<div class="container">
<h1><b>Easy challenges</b></h1>
<?php
    require 'scr/dbh.scr.php';
    $challenge_difficulty = "easy";
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_difficulty='$challenge_difficulty';";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $progLang = $row['challenge_prog_language'];
                if ($progLang == "Python"){
                    $icon = "pics/python.png";
                    $link = "https://www.python.org/";
                  }elseif($progLang == "PHP"){
                    $icon = "pics/php.png";
                    $link = "https://php.net/";
                  }elseif($progLang == "JavaScript"){
                    $icon = "pics/javascript.jpeg";
                    $link = "https://www.javascript.com/";
                  }
                ?>
                <form name="form" action="challenge_info?c=<?php echo $row['challenge_id'];?>" method="post">
    <div id="card" class="card bg-success mb-3" onclick="this.parentNode.submit()">

        <div class="card-body">
            <h4 class="card-title"><b><?php echo $row['challenge_title']; ?></b></h4>
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
            <img src="<?php echo $icon; ?>" id="icon">
        </div>
    </div>
</form>
                <?php
            }
        }
    }
    ?>