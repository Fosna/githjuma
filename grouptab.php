<link rel="stylesheet" href="style/grouptab.style.css">
<!-- Dobivanje challenga iz baze -->
<div class="container">
<div class="row tab_row">
    <?php
    require 'scr/dbh.scr.php';
     $sql = "SELECT * FROM hjuma_groups;";
     if($result = mysqli_query($conn, $sql)){
         if(mysqli_num_rows($result) > 0){
             while($row = mysqli_fetch_array($result)){
    ?>
    <div id="card" class="card">
        <h1><?php echo $row['group_name']; ?></h1>
             </div>
             <?php  }
             }
            }
            ?>
            </div>
</div>
</div>