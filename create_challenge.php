<?php require 'header.php'; ?>> 
<link rel="stylesheet" href="style/create_challenge.style.css">
<form  action="scr/create_challenge.scr.php" method="post" novalidate>
  <div class="container">
    <h1>Create challenge</h1>
    <hr class="my-2">
    <div class="form-row">
      <div class="form-group col-md-5 mb-3">
        <label for="username">Title</label>
        <input type="text" class="form-control" name="challenge_title" aria-describedby="title" placeholder="Title of a challenge" required>
        <div class="invalid-feedback">
          This field can't be empty!
        </div>
      </div>
      <div class="form-group col-md-5 mb-3">
        <label for="challenge_type">Type of challenge</label>
        <select id="challenge_type" name="challenge_type" class="form-control" onchange="java_script_:show(this.options[this.selectedIndex].value)">
          <option value="def_challenge">Popular challenges from our database</option>
<?php
        if (!isset($_SESSION['id'])) {
?>    
          <option id="item_block" value="user_challenge">Your own challenge - LOGIN FOR THIS FEATURE !</option>
<?php
        }else{
?>
          <option  value="def_challenge">Your own challenge</option>
<?php 
        }
?>
        </select>
      </div>
      <div class="form-group col-md-2 mb-3">
        <label for="challenge_difficulty">Select difficulty</label>
        <select name="challenge_difficulty" class="form-control">
          <option value="easy">Easy</option>
          <option value="medium">Medium</option>
          <option value="hard">Hard</option>    
        </select>
      </div>
    </div>
    <div class="form-group" id="user_explanation" style="width: 100%;">
      <label for="challenge_user_explanation">Explain task</label>
      <input type="text" class="form-control " name="challenge_user_explanation" aria-describedby="explanation" placeholder="Explain your task to other people" required>
      <div class="invalid-feedback">
        This field can't be empty!
      </div>
    </div>
    <div class="form-group">
      <label for="challenge_description">Description</label>
      <input type="text" class="form-control" name="challenge_description" placeholder="Description of challenge" required>
      <div class="invalid-feedback">
        This field can't be empty!
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-4 mb-3">
        <label for="challenge_prog_language">Select programming language</label>
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
      <div class="form-group col-md-4 mb-3">
        <label for="password">Start date</label>
        <input class="form-control" type="date" name="challenge_start_date" value="" required/>
        <div class="invalid-feedback">
          This field can't be empty!
        </div>
      </div>
      <div class="form-group col-md-4 mb-3">
        <label for="password">Deadline</label>
        <input class="form-control" type="date" name="challenge_deadline" value="" required/>
        <div class="invalid-feedback">
          This field can't be empty!
        </div>
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
    function show(aval) {
    if (aval == "user_challenge") {
      user_explanation.style.display='inline-block';
      Form.fileURL.focus();
    } 
    else{
      user_explanation.style.display='none';
    }
  }
  var form = document.querySelector('.needs-validation');
  form.addEventListener('submit', function(event){
      if (form.checkValidity() === false){
          event.preventDefault();
          event.stopPropagation();
      }
      form.classList.add('was-validated');
  });
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
</script>