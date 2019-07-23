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
<div class="container">
  <div class="row">
    <div class="col-sm">
      <h2><?php echo $row['challenge_title'];?></h2>
    </div>
    <div class="col-sm">
      <h2 class="float-right" style="<?php if ($challenge_difficulty == "Easy"){echo "color: green;";}elseif ($challenge_difficulty == "Medium") {echo "color: yellow;";}elseif ($challenge_difficulty == "Hard") {echo "color: red;";}?>">
        <?php echo $row['challenge_difficulty'];?>
      </h2>
    </div>
    <a class="float-right" href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon" alt="" style="margin-left: 20px;"></a>
  </div>
  <p><?php echo $row['challenge_description'];?></p>
  <p>Challenge owner: <b><?php echo $challenge_owner_name;?></b></p>
  <h5>Challenge </h5>
  <p><?php echo $row['challenge_explanation'];?></p>
  <hr>
  <div class="row">
    <div class="col-md-10 mb-3">
      <div class="editor">
        <textarea class="codemirror-textarea"></textarea>
      </div>
    </div>
    <div class="col-md-2 mb-3">
      <button class="btn btn-success btn-lg" type="submit" name="button">Run Code</button>
      <hr>
      <button class="btn btn-outline-primary" type="submit" name="button">Submit Code</button>
      <hr>
      <div class="output">
        <h5>Output:</h5>
        <p>1423172445</p>
      </div>
      <hr>
    </div>
  </div>
  <link rel="stylesheet" href="plugin/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="plugin/codemirror/theme/pastel-on-dark.css">
  <script type="text/javascript" src="plugin/codemirror/lib/codemirror.js" charset="utf-8"></script>
  <!--ova skripta određuje programski jezik kompajlera  -->
  <script src="plugin/codemirror/mode/python/python.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      var code = $(".codemirror-textarea") [0];
      var editor = CodeMirror.fromTextArea(code, {
        lineNumbers : true,
        theme : "pastel-on-dark"
      });
    });
  </script>
</div>

<?php
      }
    }
  }
?>
<?php require 'footer.php' ?>
