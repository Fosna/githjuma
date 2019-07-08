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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
  <script type="text/javascript">
  $(window).load(function() {
      $(".se-pre-con").fadeOut("");;
    });
  </script>
</head>
<body onload="show1();hideExplanation();">
  <div class="se-pre-con"></div>
  <nav class="navbar fixed-top navbar-expand-lg bg-transparent">
    <a class="navbar-brand" href="main"><b>Hjuma</b></a>
<?php
    session_start();
    require 'scr/dbh.scr.php';
    if (isset($_SESSION['id'])) {
      $username = $_SESSION["username"];
?>
      <a class="btn btn-outline-secondary btn-sm" id="btn_main" href="create_challenge" style="margin-left: 15px;">Create Challenge</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; color:grey;">
              My Challenges
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="createdchallenges">Created Challenges</a>
              <a class="dropdown-item" href="joinedchallenges">Joined Challenges</a>
            </div>
          </div>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle my-2 my-sm-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="pics/icon-profile_3.png" alt="" style="width:25px;height:25px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item dropdown_username"><?php echo $username ?></a>
              <a class="dropdown-item" href="#">Account</a>
              <a class="dropdown-item" href="#">Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item btn-danger btn_logout" href="scr/logout.scr.php">Log out</a>
            </div>
          </li>
        </ul>
      </div>

<?php
    }else {
?>
        <a href="login" id="loginbtn" class="btn btn-outline-primary ml-auto"">Log In</a>
        <a href="signup" id="loginbtn" class="btn btn-primary">Sign Up</a>
<?php
    }
?>
  </nav>
  <div class="header_space"></div>
  <script type="text/javascript">
    $(function() {
      var header = $(".navbar");
      $(window).scroll(function() {    
          var scroll = $(window).scrollTop();
      
          if (scroll >= 10) {
              header.removeClass('bg-transparent').addClass("bg-dark");
          } else {
              header.removeClass("bg-dark").addClass('bg-transparent');
          }
      });
    });
  </script>