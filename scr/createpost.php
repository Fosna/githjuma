<?php require 'header.php'; ?>
  <link rel="stylesheet" href="style/login_signup.style.css">
  <div class="space">
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

  </div>
  <div class="container">
    <h1>Create post</h1>
    <form class="" action="scr/createpost.scr.php" method="post" enctype="multipart/form-data">
      <label for="name"></label>
      <div class="form-group">
      <input class="form-control" type="text" autocomplete="off"  placeholder="Name" name="title" value="">
    </div>
      <label for="description"></label>
      <div class="form-group">
      <input class="form-control" type="text1" autocomplete="off"  placeholder="Description " name="description" value="">
    </div>
      <label for="maxmembers"></label>
      <label for="comments"></label>
      <select class="form-control" id="exampleFormControlSelect1" name="comments">
        <option value="allow">Allow</option>
        <option value="dont allow">Dont allow</option>
      </select>
      <input class="btn btn-outline-danger btn-sm" id="file" style="display: none;"  type="file" name="avatar" value="">
      <input type="button" value="Choose image" class="btn btn-primary" id="file_alt"></input>
      <button type="submit" name="creategroup-submit"  class="btn btn-success">Create post</button>
    </form>
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
