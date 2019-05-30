<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <title class="title">Hjuma</title>
  <link rel="stylesheet" href="style/header.style.css">
  <link rel="stylesheet" href="style/search.style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body>
  <nav id="header" class="navbar fixed-top navbar-expand navbar-dark bg-dark navbar-fixed-top">
    <a class="navbar-brand" href="main">Hjuma</a>
    <?php
    error_reporting(0);
    if (isset($_SESSION['id'])) {
      error_reporting(0);
      ?>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active">
          </li>



          <?php

          require 'scr/dbh.scr.php';
          $owner = $_SESSION["username"];
          $sql = "SELECT * FROM hjuma_users WHERE username=?;";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL error";
          } else {
            mysqli_stmt_bind_param($stmt, "s", $owner);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($result)) {
              ?>
            </ul>

            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <div class="dropdown ">
                  <button class="btn" type="button" id="menu1" data-toggle="dropdown">
                    <?php
                    if ($row['profileimage'] == "") {
                      ?> <div class="iconHeader">
                        <img class="profileimageHeader" src="pics/icon.png">
                      </div>
                    <?php
                  } else {
                    echo '<div class="iconHeader">';
                    echo '<img class="profileimageHeader" onclick="dropdown()" src="data:image/jpeg;base64,' . base64_encode($row['profileimage']) . '"/>';
                    echo '</div>';
                  }
                  ?>
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" style="right: 0; left: auto;" role="menu" aria-labelledby="menu1">
                    <li role="presentation">
                      <p class="dropdown_username"><?php echo $_SESSION['username']; ?></p>
                    </li>
                    <hr>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation">
                      <a role="menuitem" tabindex="-1" href="#">
                        <form action="scr/logout.scr.php" method="post">
                          <button class="dropdown-item" type="submit" name="logout-submit">Log out</button>
                        </form>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>

          <?php
        }
      }
    } else {
      ?>
        <form action="login" class="ml-auto" method="post">
          <button id="loginbtn" class="btn btn-outline-primary" type="submit">Log in</button>
        </form>
        <form action="signup" method="post">
          <button id="loginbtn" class="btn btn-primary" type="submit">Sign up</button>
        </form>
      <?php
    }
    ?>
    </div>
  </nav>
  <script type="text/javascript">
    function dropdown() {
      document.getElementById("profile-dropdown").classList.toggle("show");
    }
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtns')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
  </script>