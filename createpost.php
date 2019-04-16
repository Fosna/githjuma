<?php require 'header.php'; ?>
  <link rel="stylesheet" href="style/createpost.style.css">
  <div class="box">
    <h1>Create post</h1>
    <form class="" action="scr/createpost.scr.php" method="post" enctype="multipart/form-data">
      <label for="name"></label>
      <input class="groupinput" type="text" autocomplete="off"  placeholder="Name" name="title" value="">
      <label for="description"></label>
      <input class="groupinput" type="text1" autocomplete="off"  placeholder="Description " name="description" value="">
      <label for="maxmembers"></label>
      <label for="comments"></label>
      <select class="select" name="comments">
        <option value="allow">Allow</option>
        <option value="dont allow">Dont allow</option>
      </select>
      <input type="file" name="avatar" value="">
      <button type="submit" name="creategroup-submit"  class="publish">Create post</button>
    </form>
  </div>
<?php
require 'footer.php';
?>
