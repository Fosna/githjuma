<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/creategroup.style.css">
<form  action="scr/creategroup.scr.php" method="post" novalidate>
  <div class="container">
  <h1 id="name_input" for="username">Name of the group</h1>
        <input id="title" value="" type="text" class="form-control" name="group_name" aria-describedby="title" placeholder="Title of a challenge" autocomplete="off" onkeyup="javascript:capitalize(this.id, this.value);" maxlength="15" required>
        <button  class="btn btn-success center-block" name="creategroup-submit" id="create_groupbtn" type="submit">Create Group</button>
  <div>
  <form>