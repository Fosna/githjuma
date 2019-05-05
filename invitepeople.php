<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/invitepeople.style.css">
<div class="space"></div>
<h1 class="title" style="margin-top: 100px;">Invite people to <?php echo $_SESSION['groupname'] ?></h1>
<?php
require 'searchusers.php';
?>
