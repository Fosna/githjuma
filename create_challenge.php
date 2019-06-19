<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/create_challenge.style.css">
<form  action="scr/create_challenge.scr.php" method="post" novalidate>
  <div class="container" style="margin-top:25px!important;">
    <h1>Create challenge</h1>
    <hr class="my-2">
    <div class="form-row">
      <div class="form-group col-md-5 mb-3">
        <label for="username">Title</label>
        <input id="title" value="" type="text" class="form-control" name="challenge_title" aria-describedby="title" placeholder="Title of a challenge" onkeyup="javascript:capitalize(this.id, this.value);" required>
        <div class="invalid-feedback">
          This field can't be empty!
        </div>
      </div>
      <div class="form-group col-md-5 mb-3">
        <label for="challenge_type">Type of challenge</label>
        <select id="challenge_type" name="challenge_type" class="form-control">
          <option value="def_challenge">Popular challenges from our database</option>
<?php
        if (!isset($_SESSION['id'])) {
?>    
          <option id="item_block" value="user_challenge">Your own challenge - LOGIN FOR THIS FEATURE !</option>
<?php
        }else{
?>
          <option value="user_challenge" onclick="showExplanation()">Your own challenge</option>
<?php 
        }
?>
        </select>
      </div>
      <div class="form-group col-md-2 mb-3">
        <label for="challenge_difficulty">Select difficulty</label>
        <select name="challenge_difficulty" class="form-control">
          <option value="Easy">Easy</option>
          <option value="Medium">Medium</option>
          <option value="Hard">Hard</option>    
        </select>
      </div>
    </div>
    <div class="form-group" id="user_explanation" style="width: 100%;">
      <label for="challenge_user_explanation">Explain task</label>
      <input id="explanation" value="" type="text" class="form-control " name="challenge_user_explanation" aria-describedby="explanation" placeholder="Explain your task to other people" onkeyup="javascript:capitalize(this.id, this.value);" required>
    </div>
    <div class="form-group">
      <label for="challenge_description">Description</label>
      <input id="description" value="" type="text" class="form-control" name="challenge_description" placeholder="Description of challenge" onkeyup="javascript:capitalize(this.id, this.value);">
    </div>
    <div class="form-row">
      <div class="form-group col-md-4 mb-3">
        <label for="challenge_prog_language">Select programming language</label>
        <select name="challenge_prog_language" class="form-control">
          <option value="Python">Python</option>
          <option value="PHP">PHP</option>
          <option value="C">C</option>
          <option value="C++">C++</option>
          <option value="C#">C#</option>
          <option value="JavaScript">JavaScript</option>
          <option value="Java">Java</option>
          <option value="HTML_CSS">HTML&CSS</option>
        </select>
      </div>
      <div class="form-group col-md-4 mb-3">
        <label for="password">Start date</label>
        <input class="form-control" type="date" name="challenge_start_date" value="" required/>
      </div>
      <div class="form-group col-md-4 mb-3">
        <label for="password">Deadline</label>
        <input class="form-control" type="date" name="challenge_deadline" value="" required/>
      </div>
    </div>
    <div class="form-group">
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" onclick="show1();" checked>
        <label class="custom-control-label" for="customRadioInline1">Public challenge</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" onclick="show2();">
        <label class="custom-control-label" for="customRadioInline2">Private challenge</label>
      </div>
    </div>
    <div class="form-group" id="challenge_password">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="challenge_password" placeholder="Password for challenge">
      <small class="form-text text-muted">Challenge will only be accesible for people with password!</small>
    </div>
    <button type="submit" class="btn btn-success btn-block" id="btn_createchallenge" name="create_challenge-submit">Create Challenge!</button>
   
  </div>
</form>
<script type="text/javascript">
  document.getElementById("item_block").disabled = true;

  function show1(){
  document.getElementById('challenge_password').style.display ='none';
  }
  function show2(){
  document.getElementById('challenge_password').style.display = 'block';
  }

  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();
  today = mm + '/' + dd + '/' + yyyy;

  $(function() {
  $('input[name="challenge_start_date"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2019,
    maxYear: parseInt(moment().format('YYYY'),10)
    });
  });
  $(function() {
  $('input[name="challenge_deadline"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2019,
    maxYear: parseInt(moment().format('YYYY'),10)
    });
  });
  function capitalize(textboxid, str) {
      // string with alteast one character
      if (str && str.length >= 1)
      {       
          var firstChar = str.charAt(0);
          var remainingStr = str.slice(1);
          str = firstChar.toUpperCase() + remainingStr;
      }
      document.getElementById(textboxid).value = str;
  }
  function showExplanation(){
    document.getElementById('user_explanation').style.display = 'block';
  }
</script>