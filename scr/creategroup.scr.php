<?php
  if (!isset($_POST['creategroup-submit'])) {
    exit();
  }
  else{
    require 'dbh.scr.php';
    session_start();
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $privacy = mysqli_real_escape_string($conn, $_POST['privacy']);
    $maxmembers = mysqli_real_escape_string($conn, $_POST['maxmembers']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $file = $_FILES['avatar']['tmp_name'];
    $image = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
    $image_name =addslashes($_FILES['avatar']['tmp_name']);
    $image_size = getimagesize($_FILES['avatar']['tmp_name']);
    $owner = $_SESSION['username'];
    if (empty($name) || empty($category) || empty($privacy) || empty($maxmembers) || empty($description)){
      header("Location: ../creategroup?error=empty");
      exit();
    }
    else {
      $sql = "SELECT name FROM hjuma_groups WHERE name=?";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../creategroup?sqlerror");
      }
      else {
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $result = mysqli_stmt_num_rows($stmt);
        if ($result > 0) {
          header("Location: ../creategroup?error=groupnametaken=".$name);
          exit();
        }
        else {
          $sql = "INSERT INTO hjuma_groups (name, description, category, privacy, maxmembers, owner, avatarname, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, '$image')";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "SQL error";
            }else {
              mysqli_stmt_bind_param($stmt,"sssssss", $name,$description,$category, $privacy,$maxmembers, $owner, $image_name);
              mysqli_stmt_execute($stmt);
            }
              $sql = "SELECT * FROM hjuma_users WHERE username= ?";
              $stmt = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "SQL error";
              }else {
                mysqli_stmt_bind_param($stmt, "s", $owner);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);


                    while($row = mysqli_fetch_array($result)){
                      if ($row['group1'] == "") {
                        $group = "group1";
                      }
                      elseif ($row['group2'] == "") {
                        $group = "group2";
                      }
                      elseif ($row['group3'] == "") {
                        $group = "group3";
                      }
                      elseif ($row['group4'] == "") {
                        $group = "group4";
                      }
                      elseif ($row['group5'] == "") {
                      $group = "group5";
                      }
                      else {
                        header("Location: ../main");
                      }
                    }
                  }

              if (!isset($_SESSION['id'])) {
                header("Location: ../login");
              }
              else{
                $_SESSION['group'] = $group;
                $sql1 = "UPDATE hjuma_users SET $group=? WHERE username=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql1)) {
                  echo "SQL error";
                }else {
                  mysqli_stmt_bind_param($stmt,"ss", $name, $owner);
                  mysqli_stmt_execute($stmt);
                }
                $sql = "SELECT * FROM hjuma_groups WHERE name=?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                  echo "SQL error";
                }else {
                  mysqli_stmt_bind_param($stmt, "s", $name);
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);
                      while($row = mysqli_fetch_array($result)){
                        $membercount = $row['membercount'];
                $sql2 = "UPDATE hjuma_groups SET membercount=? + 1 WHERE name=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql2)) {
                  echo "SQL error";
                }else {
                  mysqli_stmt_bind_param($stmt,"ss", $membercount, $name);
                  mysqli_stmt_execute($stmt);
                }
                      header("Location: ../main");


                }
              }
          }
        }
          }
      }
    }
