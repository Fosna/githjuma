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
                            <h1 id="profile_settings_txt">Profile settings</h1>
                            <div id="container_username">
                            <h6 id="email_username_in_modal_txt">USERNAME</h6>
                            <h5 id="users_email_username_modal"><?php echo $username; ?></h5>
                            </div>
                            <hr>
                            <div id="container_email">
                            <h6 id="email_username_in_modal_txt">EMAIL</h6>
                            <h5 id="users_email_username_modal"><?php echo $email; ?></h5>
                            <button id="change_email_btn_in_modal" class="btn btn-primary float-right">Change email</button>
                            </div>
                            <hr>
                            <button id="change_password_button_in_modal" class="btn btn-primary">Change password</button>
                            <h3 id="details_txt_in_modal">Details</h3>
                            <h6 id="account_id_modal_txt">Account ID: <?php echo $user_id; ?></h6>
                            <a href="scr/logout.scr.php" id="logout_btn_in_modal" class="btn btn-danger float-right">Log out</a>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="settingsTab">
                        <h1 id="theme">Theme</h1>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
