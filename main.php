<?php
require 'header.php';
?>
<link rel="stylesheet" href="style/main.style.css">
<link rel="stylesheet" href="style/body.style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    error_reporting(0);
    if (!isset($_SESSION['id'])) {
  ?>
      <div class="jumbotron">
          <h1 class="display-3">Discuse in real time!</h1>
          <p class="lead">Create group, Talk, Discuss, Make friends!</p>
          <hr class="my-4">
          <form class="" action="login" method="post">
            <button class="btn btn-primary btn-lg" type="submit" name="button">Create group</button>
          </form>
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

<?php
  if (isset($_GET['category'])) {
    $category = $_GET['category'];
  }
  $user = $_SESSION['username'];
  $sql = "SELECT * FROM hjuma_users WHERE username='$user' ";
  if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){

?>
<div class="container groups">
  <h1 class="display-3"></h1>
  <div class="jumbotron" >
  <div class="sidegroups">


       <?php
        if ($row['group1']==""){}
          else {
         ?>
         <form class="" action="scr/entergroup.scr.php" method="post">
           <button type="submit" name="entergroup-submit"  class="btn btn-link" value="<?php echo $row['group1'];?>">
             <input type="hidden" name="groupname" value="<?php echo $row['group1'];?>" />
             <h2 class="name" id="name"><?php echo $row['group1']; ?></h2>
           </button>
         </form>
       <?php } ?>

       <?php
        if ($row['group2']==""){}
          else {
         ?>
         <form class="" action="scr/entergroup.scr.php" method="post">
           <button type="submit" name="entergroup-submit"  class="btn btn-link" value="<?php echo $row['group2'];?>">
             <input type="hidden" name="groupname" value="<?php echo $row['group2'];?>" />
             <h2 class="name" id="name"><?php echo $row['group2']; ?></h2>

           </button>

         </form>

       <?php } ?>
       <?php
        if ($row['group3']==""){}
          else {
         ?>
         <form class="" action="scr/entergroup.scr.php" method="post">
           <button type="submit" name="entergroup-submit" class="btn btn-link" value="<?php echo $row['group3'];?>">
             <input type="hidden" name="groupname" value="<?php echo $row['group3'];?>" />
             <h2 class="name" id="name"><?php echo $row['group3']; ?></h2>

           </button>

         </form>
       <?php } ?>
       <?php
        if ($row['group4']==""){}
          else {
         ?>
         <form class="" action="scr/entergroup.scr.php" method="post">
           <button type="submit" name="entergroup-submit" class="btn btn-link" value="<?php echo $row['group4'];?>">
             <input type="hidden" name="groupname" value="<?php echo $row['group4'];?>" />
             <h2 class="name" id="name"><?php echo $row['group4']; ?></h2>

           </button>

         </form>
       <?php } ?>
       <?php
        if ($row['group5']==""){}
          else {
         ?>
         <form class="" action="scr/entergroup.scr.php" method="post">
           <button type="submit" name="entergroup-submit" class="btn btn-link" value="<?php echo $row['group5'];?>">
             <input type="hidden" name="groupname" value="<?php echo $row['group5'];?>" />
             <h2 class="name" id="name"><?php echo $row['group5']; ?></h2>

           </button>

         </form>
       <?php } ?>

</div>
</div>
         <?php
            }
          }
        }
  ?>
<h3 class="popgroups">Popular groups</h3>
<div class="categorychoose">
  <form class="" action="scr/categorychoose.scr.php" method="post" enctype="multipart/form-data">
    <label for="category"></label>
    <select class="browser-default custom-select custom-select-lg" name="category">
      <option selected="selected" value="" class="default">Select category</option>
      <option value="Movies">Movies</option>
      <option value="Politics">Politics</option>
      <option value="Video game">Video game</option>
      <option value="Life">Life</option>
      <option value="Nature">Nature</option>
      <option value="Comedy">Comedy</option>
      <option value="Music">Music</option>
      <option value="Business">Business</option>
      <option value="Technology">Technology</option>
      <option value="Sport">Sport</option>
    </select>
    <button class="btn btn-secondary" type="submit" name="category-submit">Choose</button>
    <!-- kasnije bez gumba sa ajaxom -->
  </form>
</div>
<?php
require 'grouptab.php';
require 'footer.php';
?>
