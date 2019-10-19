<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("Location: hjuma");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style/main.style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>hjuma</title>
</head>
<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>
<body>
  <div class="main">
    <h2 class="text">Popular</h2>
    <?php require 'challengetab.php'; ?>
    <?php require 'settings_modal.php'; ?>
  <div>
</body>
</html>
