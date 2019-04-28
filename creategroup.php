<?php require 'header.php'; ?>
  <link rel="stylesheet" href="style/login_signup.style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style media="screen">
  .btn-primary{
    margin: 10px;
  }
  .btn-success{
    font-size: 28px;
    margin-left: auto;
    margin-right: auto;
    display: block;
  }
  </style>
  <div class="container">
    <h1>Create group</h1>
    <form class="" action="scr/creategroup.scr.php" method="post" enctype="multipart/form-data">
      <form class="" action="scr/joingroup.scr.php" method="post">

      <label for="name"></label>
      <div class="form-group">
      <input   class="form-control" type="text" autocomplete="off"  placeholder="Name" name="name" value="">
    </div>
      <label for="description"></label>
        <div class="form-group">
      <input   class="form-control" type="text1" autocomplete="off"  placeholder="Description " name="description" value="">
    </div>
      <label for="maxmembers"></label>
        <div class="form-group">
      <input  class="form-control" type="number" autocomplete="off" name="maxmembers" value="20" checked>
    </div>
      <label  for="category"></label>
        <div class="form-group">
      <select class="form-control" id="exampleFormControlSelect1" name="category">
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
     </div>
      <label for="privacy"></label>
      <div class="form-group">
      <select class="form-control" id="exampleFormControlSelect1" name="privacy">
        <option value="public">Public</option>
        <option value="private">Private</option>
      </select>
    </div>
    <div class="custom-file">
      <input class="btn btn-outline-danger btn-sm" id="file" style="display: none;"  type="file" name="avatar" value="">
      <input type="button" value="Choose image" class="btn btn-primary" id="file_alt"></input>
      <button type="submit" class="btn btn-success" name="creategroup-submit">Create Group</button>

    </form>
    </div>

  </div>
  <script type="text/javascript">
  document.getElementById('file_alt').addEventListener('click',function(){
    document.getElementById('file').click();
});

  </script>
  <script src="./src/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner()
    $('.my-select').selectpicker();
</script>


<?php
require 'footer.php';
?>
