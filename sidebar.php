<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/sidebar.style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
<div class="sidenav">
<h1 class="text-left">My groups</h1>
<?php
    session_start();
    require 'scr/dbh.scr.php';
    $user_id = $_SESSION['id'];
    $sql = "SELECT * FROM hjuma_joined_groups WHERE joined_user = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL error";
    }else {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $group_id = $row['joined_group'];
                $sql2 = "SELECT * FROM hjuma_groups WHERE group_id = ?;";
                $stmt2 = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt2, $sql2)){
                    echo "SQL error";
                }else {
                    mysqli_stmt_bind_param($stmt2, "s",  $group_id);
                    mysqli_stmt_execute($stmt2);
                    $result2 = mysqli_stmt_get_result($stmt2);
                    if(mysqli_num_rows($result2) > 0){
                        while($row2 = mysqli_fetch_array($result2)){
                            $group_name = $row2['group_name'];
                            
?>
<a class="hjuma_btn" href="group_info?g=<?php echo $group_id;?>"><?php echo $group_name; ?></a>
<?php
                        }
                    }
                }
            }
        }
    }?>
    <hr>
                    <h1>My Challenges</h1>
                    <?php
    $sql3 = "SELECT * FROM hjuma_joined_challenges WHERE joined_user = ?";
                      $stmt3 = mysqli_stmt_init($conn);
                      if (!mysqli_stmt_prepare($stmt3, $sql3)){
                        echo "SQL error";
                      }else {
                        mysqli_stmt_bind_param($stmt3, "s", $user_id);
                        mysqli_stmt_execute($stmt3);
                        $result3 = mysqli_stmt_get_result($stmt3);
                            while($row3 = mysqli_fetch_array($result3)){
                            $joined_challenge_id = $row3['joined_challenge'];
                            $sql4 = "SELECT * FROM hjuma_challenges WHERE challenge_id = ?";
                      $stmt4 = mysqli_stmt_init($conn);
                      if (!mysqli_stmt_prepare($stmt4, $sql4)){
                        echo "SQL error";
                      }else {
                        mysqli_stmt_bind_param($stmt4, "s", $joined_challenge_id);
                        mysqli_stmt_execute($stmt4);
                        $result4 = mysqli_stmt_get_result($stmt4);
                            while($row4 = mysqli_fetch_array($result4)){  
                                $joined_challenge_title = $row4['challenge_title'];
                               ?>
                               <a class="hjuma_btn" href="challenge_info?c=<?php echo $joined_challenge_id;?>"><?php echo $joined_challenge_title; ?></a>
                       <?php
                            }
                        }
                    }
                }
                    
?>                   
                    
       
                </div>
                <div class="sidebar_space"></div>

</body>
</html>