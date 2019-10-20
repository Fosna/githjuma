<?php
require 'dbh.scr.php';
session_start();
$user_id = $_SESSION['id'];
$sql8 = "SELECT * FROM `hjuma_joined_groups` WHERE joined_user = '$user_id' ";
 
$connStatus8 = $conn->query($sql8);
 
$numberOfJoinedGroups = mysqli_num_rows($connStatus8);
 
// echo $numberOfJoinedGroups; 
// //this echo out the total number of rows returned from the query
 
?>