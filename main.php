<?php
require 'header.php';
?>
<link rel="stylesheet" href="style/main.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<link rel="stylesheet" href="style\includes\categorychoose.inc.css">
  <?php
    error_reporting(0);
    if (!isset($_SESSION['id'])) {
  ?>
      <link rel="stylesheet" href="style/hjuma.style.css">
      <h1 class="head">Discuse in real time</h1>
      <?php require 'search.php'; ?>
      <a class="groupgumb" href="login">Create group</a>
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
<div class="categorychoose">
  <form class="" action="scr/categorychoose.scr.php" method="post" enctype="multipart/form-data">
    <label for="category"></label>
    <select class="select" name="category">
      <option value="" disabled selected>Select category</option>
      <option value="Movies">Movies</option>
      <option value="Politics">Category</option>
      <option value="Video game">Video game</option>
      <option value="Life">Life</option>
      <option value="Nature">Nature</option>
      <option value="Comedy">Comedy</option>
      <option value="Music">Music</option>
      <option value="Business">Business</option>
      <option value="Technology">Technology</option>
      <option value="Sport">Sport</option>
    </select>
    <button type="submit" name="category-submit">Choose</button>
    <!-- kasnije bez gumba sa ajaxom -->
  </form>
</div>
<?php
  if (isset($_GET['category'])) {
    $category = $_GET['category'];
  }
?>

<h1 class="">Most popular groups</h1>
<?php
require 'grouptab.php';
require 'footer.php';
?>
