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
                    if(mysqli_num_rows($result) > 0){
                        while($row2 = mysqli_fetch_array($result2)){
                            $group_name = $row2['group_name'];
?>
<?php
                        }
                    }
                }
            }
        }
    }
    
?>
                <div class="sidenav">
                    <h1 id="text">Joined groups</h1>
                    <a id="joined_groups" class="btn btn-link" href="group_info?g=<?php echo $group_id;?>"><?php echo $group_name; ?></a>
                    <br>
                    <hr>
                    <h1 id="text">Joined Challenges</h1> 
                </div>
                <div class="sidebar_space"></div>

</body>
</html>