<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challengetab.style.css">
<div class="space"></div>
<div class="container">
<h1><b>Created Challenges</b></h1>
<!-- Dobivanje challenga iz baze -->
<?php
    require 'scr/dbh.scr.php';
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_owner='$user_id';";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
              $progLang = $row['challenge_prog_language'];
              $diff = $row['challenge_difficulty'];
              if ($diff == "Easy") {
                $card_color = "bg-success mb-3";
              }elseif ($diff == "Medium") {
                $card_color = "bg-warning mb-3";
              }elseif ($diff == "Hard") {
                $card_color = "bg-danger mb-3";
              }
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
<!-- Dobivanje challenga iz baze -->
<!-- Card - prikazivanje challenga -->
<form name="form" action="challenge_info?c=<?php echo $row['challenge_id'];?>" method="post">
    <div id="card" class="card <?php echo $card_color;?>" onclick="this.parentNode.submit()">

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
<!-- Card - prikazivanje challenga -->
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php
            }
        }else{
          echo '<div class="alert alert-warning" role="alert">'."You didn't created any challenges!".'</div>';
        }
    }
?>
</div>
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php require 'footer.php' ?>
