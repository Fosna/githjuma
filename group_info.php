<link rel="stylesheet" href="style/group_info.style.css">
<?php
 require 'header.php'; 
 require 'scr/dbh.scr.php';
    if (!isset($_GET['g'])) {
    header("Location: main");
    }elseif(isset($_GET['g'])){
    $group_id = $_GET['g'];
    if(!isset($_SESSION['id'])){
        header("Location: login");
    }else{
        $user_id = $_SESSION['id'];
    }
    $sql = "SELECT * FROM hjuma_groups WHERE group_id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL error";
    }else {
    mysqli_stmt_bind_param($stmt, "s", $group_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_array($result)){
            $group_name = $row['group_name'];
            $group_description = $row['group_description'];
            $main_prog_language = $row['main_prog_language'];
            $group_leader_id = $row['group_leader'];
            if ($main_prog_language == "Python"){
                $icon = "pics/python.png";
                $link = "https://www.python.org/";
              }elseif($main_prog_language == "PHP"){
                $icon = "pics/php.png";
                $link = "https://php.net/";
              }elseif($main_prog_language == "JavaScript"){
                $icon = "pics/javascript.jpeg";
                $link = "https://www.javascript.com/";
              }   
        }
    }
    $sql2 = "SELECT * FROM hjuma_users WHERE id=?";
            $stmt2 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt2, $sql2)){
              echo "SQL error";
            }else {
              mysqli_stmt_bind_param($stmt2, "s", $group_leader_id);
              mysqli_stmt_execute($stmt2);
              $result2 = mysqli_stmt_get_result($stmt2);
                  while($row2 = mysqli_fetch_array($result2)){
                    $group_leader = $row2['username'];
                 }
            }
        }
?>          
<div class="container">
  <div class="row">
    <div class="col-md-9 mb-3" style="margin-bottom: 0px!important;">
      <h1 style="margin-bottom: 0px!important;"><b><?php echo $group_name;?></b></h1>
    </div>
    <div class="col-md-2 mb-3 float-right" style="margin-bottom:0px!important;">
      <p style="margin-bottom:0px!important;float:right!important;">Group leader:<br><b><?php echo $group_leader?></b></p>
    </div>
    <div class="col-md-1 mb-3 float-right" style="margin-bottom: 0px!important;">
    </div>
  </div>
  <hr>
  <div class="col-md-2 mb-3 float-right" style="margin-bottom: 0px!important;">
      <a class="" href="<?php echo $link; ?>"><img src="<?php echo $icon; ?>" id="icon"></a>
  </div>
  <div class="col-sm">
    <h5>Description</h5>
    <p><?php echo $group_description;?></p>
  </div>
  <?php if($group_leader_id == $user_id){?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#requestedUsers">
  Requested Users
</button>
<div class="modal fade" id="requestedUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
  </div>
  <?php }else{ ?>
  <form action="scr/requestjoin_group.scr.php" method="post"> 
  <input type="hidden" name="group_id" value="<?php echo $group_id; ?> ">
  <button class="btn btn-primary btn-lg btn-block" name="joinrequest_submit">Join Request</button>
  </form>
  <?php } ?>