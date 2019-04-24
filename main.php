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
      <div class="creategroup_container">
        <form class="" action="login" method="post">
          <h2 class="text_continer">Create group, talk, meet, discuss, make friends!</h2>
          <button type="submit" class="creategroup_login" name="button">Create group</button>
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
<div class="categorychoose">
  <form class="" action="scr/categorychoose.scr.php" method="post" enctype="multipart/form-data">
    <label for="category"></label>
    <select class="select" name="category">
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
    <button class="categorysubmit" type="submit" name="category-submit">Choose</button>
    <!-- kasnije bez gumba sa ajaxom -->
  </form>
</div>
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
<div class="sidegroups">
       <?php
        if ($row['group1']==""){}
          else {
         ?>
         <form class="" action="scr/entergroup.scr.php" method="post">
           <button type="submit" name="entergroup-submit"  class="mygroups" value="<?php echo $row['group1'];?>">
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
           <button type="submit" name="entergroup-submit"  class="mygroups" value="<?php echo $row['group2'];?>">
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
           <button type="submit" name="entergroup-submit" class="mygroups" value="<?php echo $row['group3'];?>">
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
           <button type="submit" name="entergroup-submit" class="mygroups" value="<?php echo $row['group4'];?>">
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
           <button type="submit" name="entergroup-submit" class="mygroups" value="<?php echo $row['group5'];?>">
             <input type="hidden" name="groupname" value="<?php echo $row['group5'];?>" />
             <h2 class="name" id="name"><?php echo $row['group5']; ?></h2>

           </button>

         </form>
       <?php } ?>

</div>
         <?php
            }
          }
        }

  ?>

<?php
require 'grouptab.php';
require 'footer.php';
?>
