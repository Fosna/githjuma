<?php 
if (!isset($_POST['-submit'])) {
    exit();
  }
  elseif (isset($_POST['-submit'])) {
    require 'dbh.scr.php';
    
  }