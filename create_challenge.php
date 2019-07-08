<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/create_challenge.style.css">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<form  action="scr/create_challenge.scr.php" method="post" novalidate>
  <div class="container" style="margin-top:25px!important;">
<?php
  if(!isset($_SESSION['id'])){
?>
  <div class="alert alert-info alert-dismissible fade show" role="alert">
    <a href="login" class="alert-link">Log in</a> to modify your challenge once you made one!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php }?>
    <h1>Create Challenge</h1>
    <hr class="my-2">
    <div class="form-row">
      <div class="form-group col-md-10 mb-3">
        <label for="username">Title</label>
        <input id="title" value="" type="text" class="form-control" name="challenge_title" aria-describedby="title" placeholder="Title of a challenge" onkeyup="javascript:capitalize(this.id, this.value);" required>
        <div class="invalid-feedback">
          This field can't be empty!
        </div>
      </div>
      <div class="form-group col-md-2 mb-3">
        <label for="challenge_difficulty">Difficulty</label>
        <select name="challenge_difficulty" class="form-control">
          <option value="Easy">Easy</option>
          <option value="Medium">Medium</option>
          <option value="Hard">Hard</option>    
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline3" name="challenge_type" value="def_challenge" class="custom-control-input" onclick="hideExplanation();" checked>
        <label class="custom-control-label" for="customRadioInline3">Challenge from our database</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
<?php 
      if (!isset($_SESSION['id'])){
?>
        <input type="radio" id="customRadioInline4" name="challenge_type" value="user_challenge" class="custom-control-input" onclick="showExplanation();" disabled>
        <label class="custom-control-label text-muted" for="customRadioInline4">Your own challenge - LOGIN FOR THIS FEATURE!</label>
<?php
      }else{
?>
        <input type="radio" id="customRadioInline4" name="challenge_type" value="user_challenge" class="custom-control-input" onclick="showExplanation();" >
        <label class="custom-control-label" for="customRadioInline4">Your own challenge</label>
<?php
      }
?>
      </div>
    </div>
    <div class="form-group" id="user_explanation" style="width: 100%;">
      <label for="challenge_user_explanation">Challenge explanation</label>
      <input id="explanation" value="" type="text" class="form-control " name="challenge_user_explanation" aria-describedby="explanation" placeholder="Explain your challenge task to other people" onkeyup="javascript:capitalize(this.id, this.value);" required>
      <small class="form-text text-muted">You need to explain task because people won't know what they need to do!</small>
    </div>
    <div class="form-group">
      <label for="challenge_description">Description</label>
      <input id="description" value="" type="text" class="form-control" name="challenge_description" placeholder="Description of challenge" onkeyup="javascript:capitalize(this.id, this.value);">
    </div>
    <div class="form-row">
      <div class="form-group col-md-4 mb-3">
        <label for="challenge_prog_language">Programming language</label>
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
        <label for="">Start date</label>
        <input id="start_date" class="form-control" type="datetime-local" name="challenge_start_date" value="" required/>
        <small class="form-text text-muted">Click filled circle on calendar to choose today's date!</small>
      </div>
      <div class="form-group col-md-4 mb-3">
        <label for="">End date</label>
        <input class="form-control" type="datetime-local" name="challenge_deadline" required/>
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
      <input type="text" class="form-control" name="challenge_password" placeholder="Password for challenge">
      <small class="form-text text-muted">Challenge will only be accesible for people with password!</small>
    </div>
    <button type="submit" class="btn btn-success btn-block btn-lg" id="btn_createchallenge" name="create_challenge-submit">Create Challenge!</button>
    <?php
      if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == "empty") {
          echo '<div class="alert alert-danger" role="alert">You must fill all fields</div>';
        }
      }
      //require 'footer.php';
    ?>
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
  document.getElementById('start_date').innerHTML = today + " --:-- --";

  function capitalize(textboxid, str) {
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
  function hideExplanation(){
    document.getElementById('user_explanation').style.display = 'none';
  }
  $(function() {
    $('input[name="datetimes"]').daterangepicker({
      timePicker: true,
      startDate: moment().startOf('hour'),
      locale: {
        format: 'MM/DD/YYYY H:mm:ss'
      }
    });
  });

</script>
<?php require 'footer.php' ?>