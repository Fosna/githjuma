<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hjuma</title>
    <link rel="stylesheet" href="style/header.style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </head>
  <body>
      <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="main">Hjuma</a>
<?php
            error_reporting(0);
            if (isset($_SESSION['id'])) {
              error_reporting(0);
          ?>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="btn btn-secondary" href="creategroup">Create group</a>
              </li>
<?php require 'search.php'; ?>
<?php
                require 'scr/dbh.scr.php';
                $owner = $_SESSION["username"];
                $sql = "SELECT * FROM hjuma_users WHERE username='$owner';";
                if($result = mysqli_query($conn, $sql)){
                  if(mysqli_num_rows($result) > 0){
                      while($row = mysqli_fetch_array($result)){
?>
                          <div class="dropdown">
                            <button class="btn pull-right"  type="button" id="menu1" data-toggle="dropdown">

<?php
                               if($row['profileimage'] == ""){
?>                               <div class="iconHeader">
                                    <img class="profileimageHeader" src="pics/icon.png">
                                 </div>
<?php
                               }else {
                                 echo '<div class="iconHeader">';
                                 echo '<img class="profileimageHeader" onclick="dropdown()" src="data:image/jpeg;base64,'.base64_encode( $row['profileimage'] ).'"/>';
                                 echo '</div>';
                               }
?>
                               <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                              <li role="presentation"><?php echo $_SESSION['username']; ?></li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <form action="account" method="post">
                                    <button class="btn btn-light btn-block" id="myacc" type="submit">My account</button>
                                  </form>
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <form action="mygroups" method="post">
                                    <button class="btn btn-light btn-block" id="myacc" type="submit">My groups</button>
                                  </form>
                                </a>
                              </li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <form action="invites" method="post">
                                    <button class="btn btn-light btn-block" type="submit">Invites</button>
                                  </form>
                                </a>
                              </li>
                              <li role="presentation" class="divider"></li>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="#">
                                  <form action="scr/logout.scr.php" method="post">
                                    <button class="btn btn-danger btn-block" type="submit" name="logout-submit">Log out</button>
                                  </form>
                                </a>
                              </li>
                            </ul>
                          </div>
<?php
                      }

                        }
                      }
                    }


            else {
          ?>
          <?php require 'search.php'; ?>
          <form action="login" class="ml-auto" method="post">
            <button class="btn btn-primary " style="margin-left: 10px;"   type="submit">Log in</button>
          </form>
          <form action="signup" method="post">
            <button class="btn btn-primary " style="margin-left: 10px;"  type="submit">Sign up</button>
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
