<!DOCTYPE html>
<html>
<head>
  <title class="title">hjuma</title>
  <link rel="stylesheet" href="style/header.style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="pics/favicon.ico" type="image/icon type">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <script type="text/javascript">
  $(window).load(function() {
      $(".se-pre-con").fadeOut("");;
    });
  </script>
</head>
<body onload="show1();hideExplanation();">
  <div class="se-pre-con"></div>
  <nav class="navbar fixed-top navbar-expand-lg bg-transparent">
    <a class="navbar-brand" href="main"><b>hjuma</b></a>
    <form action="search_challenges" class="form-inline my-2 my-lg-0" style="margin-left: 15px;" method="post">
      <input name="search_challenge" class="form-control mr-sm-2 search_input" type="search" placeholder="Search challenges..." aria-label="Search" autocomplete="off">
      <button name="search_challenge-submit" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <a class="btn btn-link" id="btn_main" href="create_challenge" style="text-decoration:none;color:gray;">Create Challenge</a>
<?php
    error_reporting(0);
    $tsstring = gmdate('D, d M Y H:i:s ', $timestamp) . 'GMT';
    $etag = $language . $timestamp;

    $if_modified_since = isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false;
    $if_none_match = isset($_SERVER['HTTP_IF_NONE_MATCH']) ? $_SERVER['HTTP_IF_NONE_MATCH'] : false;
    if ((($if_none_match && $if_none_match == $etag) || (!$if_none_match)) &&
        ($if_modified_since && $if_modified_since == $tsstring))
    {
        header('HTTP/1.1 304 Not Modified');
        exit();
    }
    else
    {
        header("Last-Modified: $tsstring");
        header("ETag: \"{$etag}\"");
    }
    session_start();
    require 'scr/dbh.scr.php';
    if (isset($_SESSION['id'])) {
      $username = $_SESSION["username"];
?>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle my-2 my-sm-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              My Challenges
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="createdchallenges">Created Challenges</a>
              <a class="dropdown-item" href="joinedchallenges">Joined Challenges</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle my-2 my-sm-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="pics/icon-profile_3.png" alt="" style="width:25px;height:25px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown_username"><?php echo $username ?></a>
              <a class="dropdown-item" href="#"><i class="material-icons" style="font-size:20px">account_circle</i> Account</a>
              <a class="dropdown-item" href="#"><i class="material-icons" style="font-size:20px">settings</i> Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item btn-danger btn_logout" href="scr/logout.scr.php"><i class="material-icons" style="font-size:20px">exit_to_app</i> Log out</a>
            </div>
          </li>
        </ul>
      </div>

<?php
    }else {
?>
        <a href="login" id="loginbtn" class="btn btn-outline-primary ml-auto">Log In</a>
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
