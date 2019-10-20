<?php
if (!isset($_POST['edit_submit'])) {
    exit();
}else{
    require 'dbh.scr.php';
    session_start();
    $user_id = $_SESSION['id'];
    $edited_username = mysqli_real_escape_string($conn, $_POST['edit_username']);
    $edited_email = mysqli_real_escape_string($conn, $_POST['edit_email']);
    $password_check = mysqli_real_escape_string($conn, $_POST['password_check']);

    $sql = "SELECT * FROM hjuma_users WHERE id = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "SQL error";
    }else {
        mysqli_stmt_bind_param($stmt, "s", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_array($result)){
                $password = $row['password'];
                $pwdCheck = password_verify($password_check, $password);
                if ($pwdCheck == false) {
                    header("Location: ../main?error=pass");
                    exit();
                }else{
                    $sql = "UPDATE hjuma_users SET username=?, email=? WHERE id=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        die("sql error");
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "sss", $edited_username, $edited_email, $user_id);
                        mysqli_stmt_execute($stmt);
                        unset($_SESSION['username']);
                        $_SESSION['username'] = $edited_username;
                        header("Location: ../main");
                        exit();
                    }
                }
            }
    }
}

?>  
