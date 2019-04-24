<?php require 'header.php'; ?>
    <link rel="stylesheet" href="style/grouptab.style.css">
    <link rel="stylesheet" href="style/account.style.css">
    <style media="screen">
    body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
width: 100%;
padding: 12px 20px;
margin: 8px 0;
display: inline-block;
border: 1px solid #ccc;
box-sizing: border-box;
}

/* Set a style for all buttons */

/* The Modal (background) */
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
background-color: #fefefe;
margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
border: 1px solid #888;
width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
position: absolute;
right: 25px;
top: 0;
color: #000;
font-size: 35px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: red;
cursor: pointer;
}

/* Add Zoom Animation */
.animate {
-webkit-animation: animatezoom 0.6s;
animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
from {-webkit-transform: scale(0)}
to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
from {transform: scale(0)}
to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
span.psw {
   display: block;
   float: none;
}
.cancelbtn {
   width: 100%;
}
}
    </style>
    <div class="namecontainer">
      <?php
          if (isset($_SESSION['username'])) {
            echo '<div id="username">'.$_SESSION['username'].'</div>';


          }
      ?>
      <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Change name</button>
<!--
  <div id="id01" class="modal">

    <form class="modal-content animate" action="scr/passwordconfirm.scr.php">
      <div class="imgcontainer">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      </div>

      <div class="container2"> -->
        <form class="" action="scr/passwordconfirm.scr.php" method="post">
          <input type="password" name="password" autocomplete="off" placeholder="Lozinka" value="" required>
          <button type="submit" class="submit" name="passwordconfirm-submit">Prijava</button>
        </form>

      <!-- </div>

      <div class="container2" style="background-color:#f1f1f1">


      </div>
    </form>
  </div> -->

      <?php
        require 'scr/dbh.scr.php';
        $owner = $_SESSION["username"];
        $sql = "SELECT * FROM hjuma_users WHERE username='$owner';";
        if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_array($result)){

                if($row['profileimage']==""){
      ?>
      <div class="icon">
        <img class="native_profileimage" src="pics/icon.png"/>
      </div>


      <?php     }
      else {?>

        <div class="icon">
          <?php echo '<img class="profileimage" src="data:image/jpeg;base64,'.base64_encode( $row['profileimage'] ).'"/>';  ?>

        </div>

        <?php
                }
                echo '<div class="email">'.$row['email'].'</div>';
              }
            }
          }
      ?>


      <div class="imageupload">
        <form class="" action="scr/accountupdate.scr.php" method="post" enctype="multipart/form-data">
            <input type="file" class="file" name="avatar" value="">
        <button type="submit" class="uploadfile" name="accountupdate-submit">Upload</button>

        </form>
      </div>



    </div>



    <?php
      require 'scr/dbh.scr.php';
      $owner = $_SESSION["username"];
      $sql = "SELECT * FROM hjuma_groups WHERE owner='$owner';";
      if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
    ?>
              <div class="container">
                <h2 class="name"><?php echo $row['name']; ?></h2>
                <h2 class="category"><?php echo $row['category']; ?></h2>
                <h2 class="description"><?php echo $row['description']; ?></h2>
                <h2 class="maxmembers"><?php echo $row['membercount'],"/", $row['maxmembers']; ?></h2>
                <form class="" action="scr/deletegroup.scr.php" enctype="multipart/form-data" method="post">
                  <input type="hidden" name="groupname" value="<?php echo $row['name'];?>" />
                  <button type="submit" class="join" name="deletegroup-submit">Delete</button>
                </form>
              </div>
    <?php
            }
          }
        }
    ?>


<?php require 'footer.php'; ?>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
