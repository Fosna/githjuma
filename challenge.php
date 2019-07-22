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
<!-- <div class="info_div">
  <div class="container">
    <h1><?php //echo $row['challenge_title']; ?></h1>
  </div>
</div>
<div class="editor_div" contenteditable="true">
    Editor
</div>
<table> -->
<table>
    <tr>
        <td class="info">
            <div>

            </div>
        </td>
        <td class="editor">
            <div class="tag"></div>
            <code><div class="content" contenteditable></div></code>
        </td>
    </tr>

</table>

<?php
      }
    }
  }
?>
<?php require 'footer.php' ?>
