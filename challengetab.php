<link rel="stylesheet" href="style/challengetab.style.css">
<!-- Dobivanje challenga iz baze -->
<div class="container">
<div class="row tab_row">
<?php
    $sql = "SELECT * FROM hjuma_challenges;";
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
<div class="col-sm-4">
<form name="form" action="challenge_info?c=<?php echo $row['challenge_id'];?>" method="post">
    <div id="card" class="card <?php echo $card_color;?>" onclick="this.parentNode.submit()">

        <div class="card-body">
            <h4 class="card-title"><b><?php echo $row['challenge_title']; ?></b></h4>
            <img src="<?php echo $icon; ?>" id="icon">
        </div>
    </div>
</form>
</div>

<!-- Card - prikazivanje challenga -->
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php
            }
        }
    }
?>
</div>
</div>
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
