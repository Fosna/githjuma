<?php
    if (isset($_POST['join-submit'])){
        $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
    }elseif(isset($_GET['c'])){
        $challenge_id = $_GET['c'];
    }
    echo $challenge_id;
        require 'dbh.scr.php';
        session_start();
        $user_id = $_SESSION['id'];

        $sql = "SELECT * FROM hjuma_users WHERE id='$user_id';";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $empty = $row['challenge_1'];
                }
            }
        }
        if ($empty == ""){
            $challenge_no_new = "challenge_1";
        }else{
            $sql = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'tehnooz_plasaj_login_test' AND TABLE_NAME ='hjuma_users' ORDER BY ORDINAL_POSITION DESC  LIMIT 1;";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $challenge_no = $row['COLUMN_NAME'];
            }

            //algoritam koji zadnji challenge povecava za jedan
            $mod1 = substr($challenge_no, 10);
            $mod2 = intval($mod1);
            $mod3 = $mod2 + 1;
            $mod4 = strval($mod3);
            $challenge_no_new = "challenge_".$mod4;
            $sql2 = "ALTER TABLE hjuma_users ADD COLUMN $challenge_no_new VARCHAR(20) AFTER $challenge_no";
            $conn->query($sql2);
            //echo $challenge_no;
            //echo $challenge_no_new;
            //echo $challenge_id;
            //echo $user_id;
        }
        $sql3 = "UPDATE hjuma_users SET $challenge_no_new=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql3)){
            mysqli_stmt_bind_param($stmt, "ss", $challenge_id, $user_id);
            mysqli_stmt_execute($stmt);
            header("Location: ../challenge_info?c=$challenge_id");
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        }
