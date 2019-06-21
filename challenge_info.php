<link rel="stylesheet" href="style/challenge_info.style.css">
<?php 
require 'header.php';
require 'scr/dbh.scr.php';
#ovdje ispisujemo info challenga
if (!isset($_GET['c'])) {
  header("Location: main");
}elseif(isset($_GET['c'])){
  $challenge_id = $_GET['c'];
  if(!isset($_SESSION['id'])){
    $user_id = "NONE";
  }else{
    $user_id = $_SESSION['id'];
  }
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
          $start_date = $row['challenge_start_date'];
          $deadline = $row['challenge_deadline'];
          $challenge_owner = $row['challenge_owner'];
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
<?php
            if(!isset($_SESSION['id'])){
?>
              <div class="alert alert-info alert-dismissible fade show" role="alert">
                <a href="login" class="alert-link">Log in</a> for more features!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
<?php 
            }
?>
              <div class="container">
                <div class="row">
                      <div class="col-8">
                          <div class="jumbotron greenback">
                            <h1 class="display-4"><?php echo $row['challenge_title']; ?></h1>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="jumbotron greenback right">
                              <div class="">
                                  <div class="">
                                    <div id="counter-mode">Starting in:</div>
                                  </div>
                                  <div class="">
                                    <b>
                                        <p id="counter"></p>
                                    </b>
                                  </div>    
                              </div>

                          </div>

                      </div>
                  </div>      
              </div>
              <p class="lead"><?php echo $row['challenge_description'];?></p>
              <hr class=my-4>
              <div class="container">
                <div class="row">
                      <div class="col-8">
                          <div class="jumbotron greenback" style="margin-bottom:0!important;">
                          <p class="lead" id="challenge_prog_language" style="margin-bottom:0!important;">Difficulty: <strong><b><?php echo $row['challenge_difficulty'];?></b></strong></p>
                          </div>
                      </div>
                      <div class="col-4">
                          <div class="jumbotron greenback right" style="margin-bottom:0!important;">
                            <a href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon" alt="" style="margin-left: 20px;"></a> 
                          </div>
                      </div>
                  </div>      
              </div>
              <hr class=my-4>
              <p class="">Challenge progress</p>
              <div class="progress">
                <div class="progress-bar bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
              </div>
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
<?php
            if ($challenge_owner == $user_id) {
?>
                <!--<a class="btn btn-success btn-lg btn-block" href="#" role="button">Start challenge</a>-->
                <button class="btn btn-success btn-lg btn-block" onclick="gate();">Start challenge</button>
<?php
            }else{
?>            
                <a class="btn btn-success btn-lg btn-block" href="#" role="button">Join</a>    
<?php
            }
?>
            </div>
          </div>
  <!-- Glavni opis stranice -->
  <!-- Prograss bar (treba skuzit kak cemo to pratit) -->
<?php  
    }
  }
}
require 'footer.php' ?>
<div id="test"></div>
<script>
    var gate = 0;
    function gate(){
        gate = 1;
    }
    var raw = "<?php echo $start_date?>";
    /*var date = raw.slice(0, 11);
    var year = date.slice(6, 11);
    var month = date.slice(3, 6);
    var day = date.slice(0,3);
    var finaldate = month.concat(day,year);
    console.log(date);
    console.log(finaldate);
    //document.getElementById("test").innerHTML = date2;*/
    var countDownDate = new Date(raw).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
        
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
        
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
    // Output the result in an element with id="demo"
    document.getElementById("counter").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
        
    // If the count down is over, write some text 
    if (distance < 0 || gate == 1) {
        clearInterval(x);
        document.getElementById("counter-mode").innerHTML = "Ending in: ";
        //document.getElementById("counter").innerHTML = "pokazi deadline";
        deadline();
    }
    }, 1000);

    function deadline(){
        // 22/06/2019
        // /0/ 2//201
        var raw2 = "<?php echo $deadline?>";
        /*var date = raw.slice(0, 12);
        var year = date.slice(7, 12);
        var month = date.slice(4, 7);
        var day = date.slice(1,4);
        var finaldate = month.concat(day,year);
        console.log(date);
        console.log(finaldate);*/
        var countDownDate = new Date(raw2).getTime();

        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();
            
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
            
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
        // Output the result in an element with id="demo"
        document.getElementById("counter").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
            
        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("counter-mode").innerHTML = "__________________";
            document.getElementById("counter").innerHTML = "Challenge has ended!";
        }
        }, 1000);
    }
</script>