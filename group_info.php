<?php require 'settings_modal.php'; ?>
<link rel="stylesheet" href="style/group_info.style.css">
<?php
 require 'header.php'; 
 require 'scr/dbh.scr.php';
 require 'scr/count_joined_groups.scr.php';
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
      <button class="btn btn-dark float-right" id="invite_users_btn" data-toggle="modal" data-target="#inviteUsersModal">Invite users</button>
      <div class="modal fade" id="inviteUsersModal" tabindex="-1" role="dialog" aria-labelledby="inviteUsersModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Invite users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
         $sql7 = "SELECT * FROM hjuma_users WHERE NOT (id = '$user_id' )";
         if($result7 = mysqli_query($conn, $sql7)){
          if(mysqli_num_rows($result7) > 0){
              while($row7 = mysqli_fetch_array($result7)){
                 ?>
                
<?php
              }
         }
        }
         ?>
        <div class="user-search-box">
          <input type="text" autocomplete="off" placeholder="Search users..." />
        <div class="user-result"></div>
      </div>
    </div>
  </div>
</div>
    <button type="button" id="requested_users_btn" class="btn btn-dark" data-toggle="modal" data-target="#requestedUsers">
  Requested Users
</button>
<div class="modal fade" id="requestedUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Requested users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          $sql3 = "SELECT * FROM hjuma_requested_groups WHERE requested_group = ?";
          $stmt3 = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt3, $sql3)){
            echo "SQL error";
          }else {
            mysqli_stmt_bind_param($stmt3, "s", $group_id);
            mysqli_stmt_execute($stmt3);
            $result3 = mysqli_stmt_get_result($stmt3);
                while($row3 = mysqli_fetch_array($result3)){
                  $sql4 = "SELECT * FROM hjuma_users WHERE id=?";
                  $stmt4 = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt4, $sql4)){
                    echo "SQL error";
                  }else {
                    mysqli_stmt_bind_param($stmt4, "s", $row3['requested_user']);
                    mysqli_stmt_execute($stmt4);
                    $result4 = mysqli_stmt_get_result($stmt4);
                        while($row4 = mysqli_fetch_array($result4)){
                          $user_request_username = $row4['username'];
                        }
                  }
                
          ?>
          <hr>  
        <a href="profile" id="requested_user" class="btn btn-link"><?php echo $user_request_username; ?></a>
        <?php if($user_id == $group_leader_id){ ?>
          <form action="scr/joinaccept_group.scr.php" method="post">     
          <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
          <input type="hidden" name="user_request_user_id" value="<?php echo $row3['requested_user']; ?>">                   
            <button type="submit" name="joinaccept_submit" class="btn btn-dark float-right" id="_btn">Accept</button>                 
          </form>
        
          <?php            
                          }
                        } 
                      }
        ?>
      </div>
    </div>
  </div>
  </div>
  <?php }else{ ?>
    <?php
    $sql5 = "SELECT * FROM hjuma_requested_groups WHERE requested_group = ? AND requested_user = ?;";
    $stmt5 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt5, $sql5)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt5, "ss", $group_id, $user_id);
      mysqli_stmt_execute($stmt5);
      $result5 = mysqli_stmt_get_result($stmt5);
          while($row5 = mysqli_fetch_array($result5)){
            $requested_user = $row5['requested_user'];
            $requested_group = $row5['requested_group'];
          }         
        }
        $sql6 = "SELECT * FROM hjuma_joined_groups WHERE joined_group = ? AND joined_user = ?;";
    $stmt6 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt6, $sql6)){
      echo "SQL error";
    }else {
      mysqli_stmt_bind_param($stmt6, "ss", $group_id, $user_id);
      mysqli_stmt_execute($stmt6);
      $result6 = mysqli_stmt_get_result($stmt6);
          while($row6 = mysqli_fetch_array($result6)){
            $joined_user = $row6['joined_user'];
           
          }         
        }
        if($numberOfJoinedGroups == 5){ ?>
        <h5 id="max_groups_txt">You can only join 5 groups</h5>
      <?php
        }else{ 
    if ($requested_user == $user_id || $joined_user == $user_id) {}else{
    ?>
    
      <form action="scr/requestjoin_group.scr.php" method="post"> 
      <input type="hidden" name="group_id" value="<?php echo $group_id; ?> ">
      <button class="btn btn-dark btn-lg btn-block" name="joinrequest_submit">Join Request</button>
      </form>
    
    <?php } }?>
  <?php } ?>
  <script type="text/javascript">
    $(document).ready(function(){
        $('.user-search-box input[type="text"]').on("keyup input", function(){
            /* Get input value on change */
            var user_inputVal = $(this).val();
            var user_resultDropdown = $(this).siblings(".user-result");
            if(user_inputVal.length){
                $.get("scr/user-search.scr.php", {term: user_inputVal}).done(function(data){
                    // Display the returned data in browser
                    user_resultDropdown.html(data);
                });
            } else{
              user_resultDropdown.empty();
            }
        });

        // Set search input value on click of result item
        $(document).on("click", ".user-result p", function(){
            $(this).parents(".user-search-box").find('input[type="text"]').val($(this).text());
            $(this).parent(".user-result").empty();
        });
    });
</script>