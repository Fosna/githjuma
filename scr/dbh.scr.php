<?php
$servername = "localhost";
$username = "tehnooz_toni";
$password = "tehnooz123qw";
$dbname = "tehnooz_plasaj_login_test";


$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Neuspjelo spajanje: " . mysqli_connect_error());
}
?>
