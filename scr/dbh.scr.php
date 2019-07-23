<?php
$baseservername = "localhost";
$baseusername = "tehnooz_toni";
$basepassword = "tehnooz123qw";
$basedbname = "tehnooz_plasaj_login_test";


$conn = mysqli_connect($baseservername, $baseusername, $basepassword, $basedbname);

if (!$conn) {
  die("Neuspjelo spajanje: " . mysqli_connect_error());
}
?>
