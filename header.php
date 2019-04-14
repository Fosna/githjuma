<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hjuma</title>
    <link rel="stylesheet" href="style/header.style.css">
  </head>
  <body>
    <header>
      <a href="main"><img src="https://codetheweb.blog/assets/img/icon2.png" ></a>
      <nav>
          <?php
            if (isset($_SESSION['id'])) {
              error_reporting(0);
          ?>
              <div class="float-left">
                <a class="groupbtn" href="creategroup">Create group</a>

                <form class="searching" action="scr/search.scr.php" method="post">
                  <input class="search"type="text" placeholder="Search for groups..." name="search" autocomplete="off"  value="">
                  <button type="submit" class="searchbtn" name="submit-search">Search</button>
                </form>
                <div class="search-modal">
                  <?php
                    if (isset($_SESSION['groupnamesearch'])) {
                  ?>
                  <div class="searchbox">
                    <div class="groupname"><?php echo $_SESSION['groupnamesearch']; ?></div>
                    <form action="scr/joingroup.scr.php" method="post">
                      <input type="hidden" name="groupname" value="<?php echo $_SESSION['groupnamesearch'];?>" />
                      <input type="hidden" name="membercount" value="1" />
                      <button class="joinsearch" type="submit" name="joingroup-submit">JOIN</button>
                    </form>

                  </div>

                  <?php
                    }
                  ?>
                </div>
              </div>

              <div class="dropdown">
              <button onclick="dropdown()" class="dropbtn">Profile</button>
                <div id="profile-dropdown" class="dropdown-content">
                  <div class="username"><?php echo $_SESSION['username']; ?></div>
                  <form class="" action="account" method="post">
                    <button class="dropbtns" id="myacc" type="submit">My account</button>
                  </form>
                  <form action="scr/logout.scr.php" method="post">
                    <button class="dropbtns" type="submit" name="logout-submit">Log out</button>
                  </form>
                </div>
              </div>
          <?php
            }
            else {
          ?>
          <form action="login" method="post">
            <button type="submit" class="loginb">Log in</button>
          </form>
          <form action="signup" method="post">
            <button type="submit" class="loginb">Sign up</button>
          </form>

          <?php
            }
          ?>
      </nav>
    </header>
    <div class="space"></div>
    <script type="text/javascript">
      function dropdown() {
      document.getElementById("profile-dropdown").classList.toggle("show");
      }
      window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
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
