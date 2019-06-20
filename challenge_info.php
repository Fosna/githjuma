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
            $link = "https://www.python.org/";
          }elseif($progLang == "PHP"){
            $icon = "pics/php.png";
            $link = "https://php.net/";
          }elseif($progLang == "C"){
            $icon = "pics/c.png";
            $link = "https://www.geeksforgeeks.org/c-programming-language/";
          }elseif($progLang == "C++"){
            $icon = "pics/c++.png";
            $link = "http://www.cplusplus.com/";
          }elseif($progLang == "C#"){
            $icon = "pics/c#.png";
            $link = "https://www.geeksforgeeks.org/csharp-programming-language/";
          }elseif($progLang == "Java"){
            $icon = "pics/java.jpg";
            $link = "https://www.java.com/en/";
          }elseif($progLang == "JavaScript"){
            $icon = "pics/javascript.jpeg";
            $link = "https://www.javascript.com/";
          }
?>
  <!-- Glavni opis stranice -->
          <div class="jumbotron jumbotron-fluid"> 
            <div class="container">
              <p class="lead font-weight-bold text-info" id="challenge_difficulty" style="text-align:center;"><?php //echo $row['challenge_difficulty'];?></p>
              <h1 class="display-4"><?php echo $row['challenge_title']; ?></h1>
              <p class="lead"><?php echo $row['challenge_description'];?></p>
              <hr class=my-4>
              <p class="lead" id="challenge_prog_language">Difficulty: <strong class="text-info"><?php echo $row['challenge_difficulty'];?></strong></p>
              <a href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon" alt=""></a>
              <hr class=my-4>
              <p>
                <a class="btn btn-outline-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Explanation</a>
                <button class="btn btn-outline-info" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Competitors</button>
              </p>
              <div class="row">
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <div class="card card-body">
                      <?php echo $row['challenge_explanation']; ?>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="collapse multi-collapse" id="multiCollapseExample2">
                    <div class="card card-body">
                      user10923
                    </div>
                  </div>
                </div>
              </div>
              <hr class=my-4>
              <a class="btn btn-success btn-lg btn-block" href="#" role="button">Join</a>
            </div>
          </div>
  <!-- Glavni opis stranice -->
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
