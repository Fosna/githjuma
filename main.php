<?php
require 'header.php';
?>
<link rel="stylesheet" href="style/main.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<div class="logedin">
  <?php
    error_reporting(0);
    if (!isset($_SESSION['id'])) {
  ?>
      <link rel="stylesheet" href="style/hjuma.style.css">
      <h1 class="head">Discuse in real time</h1>
      <?php require 'search.php'; ?>
      <a class="groupgumb" href="login">Create group</a>


      </div>
      <div class="modalzasearchkjtijaznamkj">
        <?php
          if (!isset($_SESSION['groupname2'])) {
          }
          else {
        ?>
            <div class="groupname"><?php echo $_SESSION['groupname2']; ?></div>
            <form action="scr/joingroup.scr.php" method="post">
              <button class="join" type="submit" name="joingroup-submit">JOIN</button>
            </form>
        <?php
          }
        ?>
      </div>
    <?php
    }
    else{
    }
    if (isset($_GET['error'])) {
      $error = $_GET['error'];
      if ($error == "groupfull") {
        echo '<div class="error">Group full!</div>';
      }
    }
  ?>
</div>
<h1 class="">Most popular groups</h1>
<?php
require 'grouptab.php';
require 'footer.php';
?>
