<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/challenge.style.css">
<div class="space"></div>
<?php
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
            $icon = "pics/python.png";
            $link = "https://www.python.org/";
            $path = "python/python.js";
            $mode = "python";
          }elseif($progLang == "PHP"){
            $icon = "pics/php.png";
            $link = "https://php.net/";
            $path = "php/php.js";
            $mode = "php";
          }elseif($progLang == "JavaScript"){
            $icon = "pics/javascript.jpeg";
            $link = "https://www.javascript.com/";
            $path = "javascript/javascript.js";
            $mode = "javascript";
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
<div class="container" style="margin-top:15px;">
  <div class="row">
    <div class="col-md-10 mb-3" style="margin-bottom: 0px!important;">
      <h2 style="margin-bottom:0px!important;"><?php echo $row['challenge_title'];?></h2>
    </div>
    <div class="col-md-2 mb-3 float-right" style="margin-bottom:0px!important;">
      <p style="margin-bottom:0px!important;float:right!important;">Challenge owner:<br><b><?php echo $challenge_owner_name;?></b></p>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-10 mb-3" style="margin-bottom: 0px!important;">
      <h4 class="<?php if ($challenge_difficulty == "Easy"){echo "text-success";}elseif ($challenge_difficulty == "Medium") {echo "text-warning";}elseif ($challenge_difficulty == "Hard") {echo "text-danger";}?>">
        <?php echo $row['challenge_difficulty'];?>
      </h4>
    </div>
    <div class="col-md-2 mb-3 float-right" style="margin-bottom: 0px!important;">
        <a class="" href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon"></a>
    </div>
  </div>
  <hr>
  <h5>Challenge </h5>
  <p><?php echo $row['challenge_explanation'];?></p>
  <hr>
    <div class="row editor_row">
      <div class="col-md-10 mb-3">
        <!-- Copyright (c) 2010, Ajax.org B.V. -->
        <div id="editor"></div>
        <script src="plugin/ace.js" charset="utf-8"></script>
        <script src="plugin/ext-language_tools.js"></script>
        <script type="text/javascript">
          var editor = ace.edit("editor");
          editor.setTheme("ace/theme/monokai");
          editor.session.setMode("ace/mode/<?php echo $mode; ?>");
          editor.setShowPrintMargin(false);
          document.getElementById('editor').style.fontSize='14px';
          editor.setValue("the new text here"); // or session.setValue
          ace.require("ace/ext/language_tools");
          editor.setOptions({
              enableBasicAutocompletion: true
          });
          function codeSubmit() {
            let output = editor.getValue();
            document.getElementById("code_raw").value = output;
          }
        </script>
      </div>
      <div class="col-md-2 mb-3">
        <button class="btn btn-success btn-lg" id="run">Run Code</button>
        <hr>
        <form class="" action="scr/code_submit.scr.php" method="post">
          <input type="hidden" name="challenge_id" value="<?php echo $challenge_id; ?>">
          <input type="hidden" name="code_raw" id="code_raw" value="">
          <button class="btn btn-outline-primary" type="submit" name="code-submit" onclick="codeSubmit();">Submit Code</button>
        </form>
        <hr>
        <div id="output"></div>
        <hr>
      </div>
    </div>
</div>
<?php
      }
    }
  }
?>
<?php require 'footer.php' ?>
