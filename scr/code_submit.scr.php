<?php
if (!isset($_POST['code-submit'])) {
    exit();
}elseif (isset($_POST['code-submit'])) {
  require 'dbh.scr.php';

  $challenge_id = mysqli_real_escape_string($conn, $_POST['challenge_id']);
  $code_raw = mysqli_real_escape_string($conn, $_POST['code_raw']);

  echo $challenge_id . " / " . $code_raw;

}
