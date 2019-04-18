<?php
  require 'dbh.scr.php';
  session_start();
  if (isset($_POST['submit-search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT * FROM hjuma_groups WHERE name LIKE '%%$search%%'";
    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);

    if($queryResult > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['groupnamesearch'] = $row['name'];
        header("Location: ../main");
      }
    }
    else{
      header("Location: ../main?search=noresult");
    }
  }
?>
