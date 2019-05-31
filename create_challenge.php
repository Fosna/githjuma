<?php require 'header.php'; ?>
<div  class="header_space"></div> 
<link rel="stylesheet" href="style/create_challenge.style.css">
<form class="content" action="scr/create_challenge.scr.php" method="post">
  <div class="container">
    <h1>Create challenge</h1>
    <hr class="my-2">
    <div class="form-group">
      <label for="username">Title</label>
      <input type="text" class="form-control" name="title" aria-describedby="title" placeholder="Title of a challenge">
    </div>
    <div class="form-group">
      <label for="password">Description</label>
      <input type="text" class="form-control" name="description" placeholder="Description of challenge">
    </div>
    <div class="form-group">
      <label for="sel1">Select programming language:</label>
      <select name="prog_language" class="form-control" id="sel1">
        <option value="python">Python</option>
        <option value="php">PHP</option>
        <option value="c">C</option>
        <option value="c++">C++</option>
        <option value="c#">C#</option>
        <option value="javascript">JavaScript</option>
        <option value="java">Java</option>
        <option value="html_css">HTML&CSS</option>
      </select>
      </div>
      <div class="form-group">
      <label for="password">Start date:</label>
      <input type="date" class="form-control" name="start_date">
    </div>
    <div class="form-group">
      <label for="password">Deadline</label>
      <input type="date" class="form-control" name="deadline">
    </div>
    <button type="submit" class="btn btn-success btn-block" name="create_challenge-submit">Create Challenge!</button>
   
  </div>
</form>