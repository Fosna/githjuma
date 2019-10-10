<link rel="stylesheet" href="style/grouptab.style.css">
<!-- Dobivanje challenga iz baze -->
<div class="container">
<div class="row tab_row">
<?php
    $sql = "SELECT * FROM hjuma_groups;";
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
              $groupLeader = $row['challenge_prog_language'];
?>
<!-- Dobivanje challenga iz baze -->
<!-- Card - prikazivanje challenga -->
<div class="col-sm-12">
    <form name="form" action="challenge_info?c=<?php echo $row['group_id'];?>" method="post">
        <div id="card" class="card <?php echo $card_color;?>" onclick="this.parentNode.submit()">
            <div class="card-body">
                <h1 class="card-title"><b><?php echo $row['group_name']; ?></b></h1>
            </div>
        </div>
    </form>
</div>

<!-- Card - prikazivanje challenga -->
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
<?php
            }
        }
    }
?>
</div>
</div>
<!-- Zavrsetak php skripte koja vuce iz sql baze -->
