<?php
session_start();
require 'scr/dbh.scr.php';
$user_id = $_SESSION['id'];
$sql5 = "SELECT * FROM hjuma_users WHERE id = ?;";
            $stmt5 = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt5, $sql5)){
              echo "SQL error";
            }else {
              mysqli_stmt_bind_param($stmt5, "s", $user_id);
              mysqli_stmt_execute($stmt5);
              $result5 = mysqli_stmt_get_result($stmt5);
                  while($row5 = mysqli_fetch_array($result5)){
                      $email = $row5['email'];
                      
                  }
            }
?>
<link rel="stylesheet" href="style/settings_modal.style.css">
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#profileTab" class="btn btn-dark" id="profilebtnTab" aria-controls="uploadTab" role="tab" data-toggle="tab">Profile <span class="badge badge-dark"><img src="pics/icon-profile_3.png" class="img-fluid" id="icon_in_profile_btn"> </span></a>
                        </li>
                        <!-- <li role="presentation"><a href="#settingsTab" class="btn btn-dark " id="settingsbtnTab" aria-controls="browseTab" role="tab" data-toggle="tab">Settings</a>
                        </li> -->
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="profileTab">
                            <div class="row">
                                <div class="col-md-10 mb-2">
                                    <h1 class="profile_settings_txt">Profile settings</h1>
                                </div>
                                <div class="col-md-2 mb-2 float-right">
                                    <button id="settings_edit_icon" class="btn float-right" onclick="editAcc();"><p style="margin-top:5px;color:white;">Edit</p><img src="pics/edit.png" alt="" style="width:24px;height:24px;margin-top:30px;">
                                </div>
                            </div>
                            <div class="container_username">
                                <h6 class="email_username_in_modal_txt">USERNAME</h6>
                                <h5 id="settings_username" class="users_email_username_modal"><?php echo $username; ?></h5>
                                <div class="container edit_input">
                                    <input id="settings_edit_username" class="form-control" type="text" placeholder="Type new username here...">
                                </div>
                            </div>
                            <hr>
                            <div class="container_email">
                                <h6 class="email_username_in_modal_txt">EMAIL</h6>
                                <h5 id="settings_email" class="users_email_username_modal"><?php echo $email; ?></h5>
                                <div class="container edit_input">
                                    <input id="settings_edit_email" class="form-control" type="text" placeholder="Type new email here...">
                                </div>
                            </div>
                            <div class="container" style="margin-top: 10px;">
                                <button id="settings_cancel_btn" class="btn btn-primary float-right save_changes_btn">Save Changes</button>
                                <button id="settings_save_btn" class="btn btn-outline-secondary float-right" onclick="canceleditAcc();">Cancel</button>
                            </div>
                            <h3 class="details_txt_in_modal">Details</h3>
                            <h6 class="account_id_modal_txt">Account ID: <?php echo $user_id; ?></h6>
                            <a href="scr/logout.scr.php" id="logout_btn_in_modal" class="btn btn-danger float-right">Log out</a>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="settingsTab">
                            <h1 class="theme">Theme</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('settings_edit_username').style.display = 'none';
document.getElementById('settings_edit_email').style.display = 'none';
document.getElementById('settings_cancel_btn').style.display = 'none';
document.getElementById('settings_save_btn').style.display = 'none';
function editAcc(){
    document.getElementById('settings_edit_icon').style.display = 'none';
    document.getElementById('settings_username').style.display = 'none';
    document.getElementById('settings_email').style.display = 'none';
    document.getElementById('settings_edit_username').style.display = 'block';
    document.getElementById('settings_edit_email').style.display = 'block';
    document.getElementById('settings_cancel_btn').style.display = 'block';
    document.getElementById('settings_save_btn').style.display = 'block';
}
function canceleditAcc(){
    document.getElementById('settings_edit_icon').style.display = 'block';
    document.getElementById('settings_username').style.display = 'block';
    document.getElementById('settings_email').style.display = 'block';
    document.getElementById('settings_edit_username').style.display = 'none';
    document.getElementById('settings_edit_email').style.display = 'none';
    document.getElementById('settings_cancel_btn').style.display = 'none';
    document.getElementById('settings_save_btn').style.display = 'none';
}
</script>