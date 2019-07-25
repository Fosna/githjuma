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
    header("Location: login");
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
          $challenge_duration = $row['challenge_duration'];
          $challenge_owner = $row['challenge_owner'];
          $progLang = $row['challenge_prog_language'];
          $password = $row['challenge_password'];
          if ($progLang == "Python"){
            $icon = "pics/python.jpeg";
            $link = "https://www.python.org/";
          }elseif($progLang == "PHP"){
            $icon = "pics/php.png";
            $link = "https://php.net/";
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
            $sql5 = "SELECT * FROM hjuma_joined_challenges WHERE joined_challenge = ? AND joined_user = ?;";
            $stmt5 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt5, $sql5)){
              echo "SQL error";
            }else {
              mysqli_stmt_bind_param($stmt5, "ss", $challenge_id, $user_id);
              mysqli_stmt_execute($stmt5);
              $result5 = mysqli_stmt_get_result($stmt5);
                  while($row5 = mysqli_fetch_array($result5)){
                      $joined_challenge = $row5['joined_challenge'];
                      $joined_user = $row5['joined_user'];
                  }
            }
?>
            <div class="container" style="margin-top:25px;">
              <div class="row">
                <div class="col-md-9 mb-3" style="margin-bottom: 0px!important;">
                  <h1 style="margin-bottom: 0px!important;"><?php echo $row['challenge_title'];?></h1>
                </div>
                <div class="col-md-2 mb-3 float-right" style="margin-bottom:0px!important;">
                  <p style="margin-bottom:0px!important;float:right!important;">Challenge owner:<br><b><?php echo $challenge_owner_name;?></b></p>
                </div>
                <div class="col-md-1 mb-3 float-right" style="margin-bottom: 0px!important;">
<?php
                if($user_id == $challenge_owner){
?>
                    <button class="btn" data-toggle="modal" data-target="#exampleModal"><i class="material-icons" style="font-size:36px">delete_forever</i></button>
<?php
                }else{
                  if ($joined_challenge == $challenge_id && $joined_user == $user_id) {
?>
                    <button class="btn" data-toggle="modal" data-target="#exampleModal"><i class="material-icons" style="font-size:36px">exit_to_app</i></button>
<?php
                  }
                }
?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-10 mb-3" style="margin-bottom: 0px!important;">
                  <h1 class="<?php if ($challenge_difficulty == "Easy"){echo "text-success";}elseif ($challenge_difficulty == "Medium") {echo "text-warning";}elseif ($challenge_difficulty == "Hard") {echo "text-danger";}?>">                    <?php echo $row['challenge_difficulty'];?>
                  </h1>
                </div>
                <div class="col-md-2 mb-3 float-right" style="margin-bottom: 0px!important;">
                    <a class="" href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon"></a>
                </div>
              </div>
              <hr>
<?php
                  if($user_id == $challenge_owner){
?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Delete Challenge</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          You are about to delete your challenge!
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                          <form action="scr/delete_challenge.scr.php" method="post">
                            <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                            <input type="hidden" name="challenge_owner" value="<?php echo $challenge_owner; ?>">
                            <button type="submit" name="delete_challenge-submit" class="btn btn-danger">Delete</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
<?php
                  }else{
?>
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Leave Challenge</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        You are about to leave challenge!
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <form action="scr/leave_challenge.scr.php" method="post">
                          <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                          <button type="submit" name="leave_challenge-submit" class="btn btn-danger">Leave</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
<?php
                }
?>
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
                $ended = "display:none;";
              }elseif ($challenge_status == "ACTIVE"){
                $start_challenge_btn_style = "display:none;";
                $enter_editor_btn_style = "display:block;";
                $ended = "display:none;";
              }elseif ($challenge_status == "EXPIRED"){
                $start_challenge_btn_style = "display:none;";
                $enter_editor_btn_style = "display:none;";
                $ended = "display:block;";
              }
?>
              <form action="scr/status.scr.php" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <input type="hidden" name="challenge_status" value="ACTIVE">
                <button type="submit" name="status-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px; <?php echo $start_challenge_btn_style; ?>">Start Challenge</button>
              </form>
              <form action="challenge?c=<?php echo $challenge_id; ?>" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <button type="submit" name="challenge-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px; <?php echo $enter_editor_btn_style; ?>">Enter Editor</button>
              </form>
              <h1 style="<?php echo $ended; ?>">Challenge Ended!</h1>
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
                if($password == ""){
?>
              <form action="scr/join_challenge.scr.php" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <input type="hidden" name="challenge_status" value="<?php echo $challenge_status; ?>">
                <button type="submit" name="joinchallenge-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px;">Join Challenge</button>
              </form>
<?php
                }else{
?>
              <button class="btn btn-primary btn-block btn-lg" data-toggle="modal" data-target="#joinModal" style="margin-top:15px;">Join Challenge</button>
              <div class="modal fade" id="joinModal" tabindex="-1" role="dialog" aria-labelledby="joinModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="joinModalLabel">Join Challenge</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="scr/join_challenge.scr.php" method="post">
                      <div class="modal-body">
                        <label for="">Challenge password</label>
                        <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                        <input type="hidden" name="challenge_status" value="<?php echo $challenge_status; ?>">
                        <input value="" type="password" class="form-control" name="challenge_password_entered" aria-describedby="title" placeholder="Type password for entering">
                      </div>
                      <div class="modal-footer">
                          <button type="submit" name="joinchallenge-submit" class="btn btn-success btn-block btn-lg">Join</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
<?php
                }
              }else{
                /*if ($challenge_status == "PENDING"){
                  $challenge_submit_btn_status = "disabled";
                  $challenge_submit_btn_label = "Waiting for owner to start a challenge!";
                }elseif ($challenge_status == "ACTIVE"){
                  $challenge_submit_btn_status = "";
                  $challenge_submit_btn_label = "";
                }elseif ($challenge_status == "EXPIRED"){
                  $challenge_submit_btn_style = "display:none!important;";
                  $challenge_submit_btn_label = "";
                }*/
                switch ($challenge_status) {
                  case "PENDING":
                      $challenge_submit_btn_status = "disabled";
                      $challenge_submit_btn_label = "Waiting for owner to start a challenge!";
                      break;
                  case "ACTIVE":
                      $challenge_submit_btn_status = "";
                      $challenge_submit_btn_label = "";
                      break;
                  case "EXPIRED":
                      $challenge_submit_btn_style = "display:none!important;";
                      $challenge_submit_btn_label = "";
                      break;
                  default:
              }
?>
              <form action="challenge?c=<?php echo $challenge_id; ?>" method="post">
                <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
                <button type="submit" name="challenge-submit" class="btn btn-primary btn-block btn-lg" style="margin-top:15px; <?php echo $challenge_submit_btn_style;?>" <?php echo $challenge_submit_btn_status;?>>Enter Editor</button>
                <small class="form-text text-muted"><?php echo $challenge_submit_btn_label;?></small>
              </form>
<?php
              }
            }
              $sql3 = "SELECT * FROM hjuma_joined_challenges WHERE joined_challenge = ?";
              $stmt3 = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt3, $sql3)){
                echo "SQL error";
              }else {
                mysqli_stmt_bind_param($stmt3, "s", $challenge_id);
                mysqli_stmt_execute($stmt3);
                $result3 = mysqli_stmt_get_result($stmt3);
                    while($row3 = mysqli_fetch_array($result3)){
                      $sql4 = "SELECT * FROM hjuma_users WHERE id=?";
                      $stmt4 = mysqli_stmt_init($conn);
                      if (!mysqli_stmt_prepare($stmt4, $sql4)){
                        echo "SQL error";
                      }else {
                        mysqli_stmt_bind_param($stmt4, "s", $row3['joined_user']);
                        mysqli_stmt_execute($stmt4);
                        $result4 = mysqli_stmt_get_result($stmt4);
                            while($row4 = mysqli_fetch_array($result4)){
                              $joined_user_name = $row4['username'];
                            }
                      }
?>
                <div class="text-center profile_card">
                    <img src="pics/icon-profile_3.png" alt="" class="card_profile_img">
                    <div class="card_username">
                        <?php echo $joined_user_name; ?>
                    </div>
                </div>
            </div>
<?php
                  }
            }
    }
  }
}
//require 'footer.php';
?>
