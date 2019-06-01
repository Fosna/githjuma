<?php require 'header.php'; ?>> 
<link rel="stylesheet" href="style/create_challenge.style.css">
<form class="content" action="scr/create_challenge.scr.php" method="post">
  <div class="container">
    <h1>Create challenge</h1>
    <hr class="my-2">
    <div class="form-group">
      <label for="username">Title:</label>
      <input type="text" class="form-control" name="challenge_title" aria-describedby="title" placeholder="Title of a challenge">
    </div>
    <div class="form-group">
      <label for="challenge_type">Type of challenge</label>
      <select id="challenge_type" name="challenge_type" class="form-control" onchange="java_script_:show(this.options[this.selectedIndex].value)">
        <option value="def_challenge">Random most popular challenges from our database</option>
<?php
        if (!isset($_SESSION['id'])) {
?>    
        <option id="item_block" value="user_challenge">Your own challenge wich you need to create on your own - Login for this feature!</option>¸
<?php
        }else{
?>
        <option  value="user_challenge">Your own challenge wich you need to create on your own</option>
<?php 
        }
?>
      </select>
    </div>
    <div class="form-group" id="user_explanation">
      <label for="challenge_user_explanation">Text area:</label>
      <input type="text" class="form-control" name="challenge_user_explanation" aria-describedby="explanation" placeholder="Explain what users need to do">
    </div>
    <div class="form-group">
      <label for="challenge_difficulty">Select difficulty:</label>
      <select name="challenge_difficulty" class="form-control">
        <option value="easy">Easy</option>
        <option value="medium">Medium</option>
        <option value="hard">Hard</option>    
      </select>
    </div>
    <div class="form-group">
      <label for="challenge_description">Description:</label>
      <input type="text" class="form-control" name="challenge_description" placeholder="Description of challenge">
    </div>
    <div class="form-group">
      <label for="challenge_prog_language">Select programming language:</label>
      <select name="challenge_prog_language" class="form-control">
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
      <input type="date" class="form-control" name="challenge_start_date">
    </div>
    <div class="form-group">
      <label for="password">Deadline</label>
      <input type="date" class="form-control" name="challenge_deadline">
    </div>
    <div class="form-group">
      <label for="password">Pasword:</label>
      <input type="password" class="form-control" name="challenge_password" placeholder="Password of challenge">
    </div>
    <button type="submit" class="btn btn-success btn-block" id="btn_createchallenge" name="create_challenge-submit">Create Challenge!</button>
   
  </div>
</form>
<script type="text/javascript">
    document.getElementById("item_block").disabled = true;
    function show(aval) {
    if (aval == "user_challenge") {
      user_explanation.style.display='inline-block';
    Form.fileURL.focus();
    } 
    else{
      user_explanation.style.display='none';
    }
  }
</script>