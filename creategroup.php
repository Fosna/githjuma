<?php require 'header.php'; ?>
  <link rel="stylesheet" href="style/creategroup.style.css">
  <h1>Create group</h1>
  <form class="" action="scr/creategroup.scr.php" method="post" enctype="multipart/form-data">
    <form class="" action="scr/joingroup.scr.php" method="post">

    <label for="name"><b>Group name:</b></label>
    <input class="groupinput" type="text" autocomplete="off"  placeholder="Name" name="name" value="">
    <label for="description"><b>Description</b></label>
    <input class="groupinput" type="text1" autocomplete="off"  placeholder="Description " name="description" value="">
    <label for="maxmembers"><b>Username</b></label>
    <input class="groupinput" type="number" autocomplete="off" name="maxmembers" value="20" checked>
    <label for="category"><b>Username</b></label>
    <select class="select" name="category">
      <option value="Movies">Movies</option>
      <option value="Politics">Category</option>
      <option value="Video game">Video game</option>
      <option value="Life">Life</option>
      <option value="Nature">Nature</option>
      <option value="Comedy">Comedy</option>
      <option value="Music">Music</option>
      <option value="Business">Business</option>
      <option value="Technology">Technology</option>
      <option value="Sport">Sport</option>
    </select>
    <label for="privacy"><b>Username</b></label>
    <select class="select" name="privacy">
      <option value="public">Public</option>
      <option value="private">Private</option>
    </select>
    <input type="file" name="avatar" value="">
    <button type="submit" name="creategroup-submit"  class="publish">Create Group</button>

  </form>

<?php
require 'footer.php';
?>
