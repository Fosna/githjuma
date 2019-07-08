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
          $challenge_owner = $row['challenge_owner'];
          $challenge_difficulty = $row['challenge_difficulty'];
          $challenge_status = $row['challenge_status'];
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
          $sql2 = "SELECT * FROM hjuma_users WHERE id=?";
            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)){
              echo "SQL error";
            }else {
              mysqli_stmt_bind_param($stmt2, "s", $challenge_owner);
              mysqli_stmt_execute($stmt2);
              $result2 = mysqli_stmt_get_result($stmt2);
                  while($row2 = mysqli_fetch_array($result2)){
                    $challenge_owner_name = $row2['username'];
                  }
            }
?>
            <div class="container" style="margin-top:25px;">
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
              <div class="row">
                <div class="col-sm">
                  <h1><?php echo $row['challenge_title'];?></h1>
                </div>
                <div class="col-sm">
                  <h1 class="float-right" style="<?php if ($challenge_difficulty == "Easy"){echo "color: green;";}elseif ($challenge_difficulty == "Medium") {echo "color: yellow;";}elseif ($challenge_difficulty == "Hard") {echo "color: red;";}?>">
                    <?php echo $row['challenge_difficulty'];?>
                  </h1>
                </div>
                  <a class="float-right" href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon" alt="" style="margin-left: 20px;"></a> 
              </div>
              <p><?php echo $row['challenge_description'];?></p>
              <p>Challenge owner: <b><?php echo $challenge_owner_name;?></b></p>
              <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Challenge explanation
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      <?php echo $row['challenge_explanation'];?>
                    </div>
                  </div>
                </div>
              </div>
<?php
            if($user_id == $challenge_owner){
              if ($challenge_status == "PENDING"){
                $start_challenge_btn_style = "display:block;"; 
                $enter_editor_btn_style = "display:none;"; 
              }elseif ($challenge_status == "ACTIVE"){
                $start_challenge_btn_style = "display:none;"; 
                $enter_editor_btn_style = "display:block;"; 
              }elseif ($challenge_status == "EXPIRED"){
                $start_challenge_btn_style = "display:none;"; 
                $enter_editor_btn_style = "display:none;"; 
              }
?>
              <form action="scr/status.scr.php" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <input type="hidden" name="challenge_status" value="ACTIVE">
                <button type="submit" name="status-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px; <?php echo $start_challenge_btn_style; ?>">Start Challenge</button>
              </form>
              <form action="challenge" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <button type="submit" name="challenge-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px; <?php echo $enter_editor_btn_style; ?>">Enter Editor</button>
              </form>
<?php 
            }else{
              $sql = "SELECT * FROM hjuma_joined_challenges WHERE joined_challenge = ? AND joined_user = ?;";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error";
              }else {
                mysqli_stmt_bind_param($stmt, "ss", $challenge_id, $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_array($result)){
                        $joined_challenge = $row['joined_challenge'];
                        $joined_user = $row['joined_user'];
                    }
              } 
              #provjerava jesmo li već ušli u challenge
              if(!$joined_challenge == $challenge_id && !$joined_user == $user_id){
?>
              <form action="scr/join_challenge.scr.php" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <input type="hidden" name="challenge_status" value="<?php echo $challenge_status; ?>">
                <button type="submit" name="joinchallenge-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px;">Join Challenge</button>
              </form>
<?php
              }else{
                if ($challenge_status == "PENDING"){
                  $challenge_submit_btn_status = "disabled";
                  $challenge_submit_btn_label = "Waiting for owner to start a challenge!";
                }elseif ($challenge_status == "ACTIVE"){
                  $challenge_submit_btn_status = "";
                  $challenge_submit_btn_label = "";
                }elseif ($challenge_status == "EXPIRED"){
                  $challenge_submit_btn_style = "display:none!important;";
                  $challenge_submit_btn_label = "";
                }
?>
              <form action="challenge" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <button type="submit" name="challenge-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px; <?php echo $challenge_submit_btn_style;?>" <?php echo $challenge_submit_btn_status;?>>Enter Editor</button>
                <small class="form-text text-muted"><?php echo $challenge_submit_btn_label;?></small>
              </form>
<?php
              }
            }
?>
            </div>
<?php
    }
  }
}
