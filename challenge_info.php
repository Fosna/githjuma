<link rel="stylesheet" href="style/challenge_info.style.css">
<?php 
require 'header.php';
require 'scr/dbh.scr.php';
#ovdje ispisujemo info challenga
if (!isset($_GET['c'])) {
  header("Location: main");
}elseif(isset($_GET['c'])){
  $challenge_id = $_GET['c'];
  #ako neko pokusa upisat id a da on ne postoji vraca ga u main
  $sql = "SELECT challenge_id FROM hjuma_challenges WHERE challenge_id=?";
  $stmt = mysqli_stmt_init($conn);
  if (mysqli_stmt_prepare($stmt, $sql)){
    mysqli_stmt_bind_param($stmt, "s", $challenge_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $result = mysqli_stmt_num_rows($stmt);
    if (!$result > 0) {
      header("Location: main");
      exit();
    }
  }
  $sql = "SELECT * FROM hjuma_challenges WHERE challenge_id = ?;";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)){
    echo "SQL error";
  }else {
    mysqli_stmt_bind_param($stmt, "s", $challenge_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
          $progLang = $row['challenge_prog_language'];
          if ($progLang == "Python"){
            $icon = "pics/python.jpeg";
          }elseif($progLang == "PHP"){
            $icon = "pics/php.png";
          }elseif($progLang == "C"){
            $icon = "pics/c.png";
          }elseif($progLang == "C++"){
            $icon = "pics/c++.png";
          }elseif($progLang == "C#"){
            $icon = "pics/c#.png";
          }elseif($progLang == "Java"){
            $icon = "pics/java.jpg";
          }elseif($progLang == "JavaScript"){
            $icon = "pics/javascript.jpeg";
          }
?>
  <!-- Glavni opis stranice -->
          <div class="jumbotron jumbotron-fluid"> 
            <div class="container">
              <h1 class="display-4"><?php echo $row['challenge_title']; ?></h1>
              <p class="lead"><?php echo $row['challenge_description'];?></p>
              <hr class=my-4>
              <!--<p class="lead" id="challenge_prog_language"><?php //echo $row['challenge_prog_language'];?></p>-->
              <img src="<?php echo $icon; ?>" id="icon" alt="">
              <p class="lead" id="challenge_difficulty"><?php echo $row['challenge_difficulty'];?></p>
              <hr class=my-4>
              <p><?php echo $row['challenge_explanation']; ?> </p>
              <hr class=my-4>
              <a class="btn btn-primary btn-lg" href="#" role="button">Join</a>
              <a class="btn btn-outline-info btn-lg" role="button" id="seecompetitorsbtn" data-toggle="modal" data-target="#exampleModalCenter">Competitors</a>
            </div>
          </div>
  <!-- Glavni opis stranice -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Competitors</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          User1
          <br>
          User2
          <br>
          User3
          <br>
          itd
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <!-- Prograss bar (treba skuzit kak cemo to pratit) -->
<?php 
      if (!isset($_SESSION['id'])) { ?>
          <div class="alert alert-primary" id="alert" role="alert">Log in for more features!</div>
<?php   
      }     
    }
  }
}
?>
<?php require 'footer.php' ?>
