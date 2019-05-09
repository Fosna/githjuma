<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/createevent.style.css">
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
    .space{
    margin-top: 90px;
    }
</style>

</div>
<div class="container">
    <h1>Create event</h1>
    <hr class="my-2">
    <form class="" action="scr/createevent.scr.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Event name:</label>
            <input class="form-control" type="text" autocomplete="off"  placeholder="Enter name for your event" name="name" value="">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input class="form-control" type="text1" autocomplete="off"  placeholder="Tell people more about your event" name="description" value="">
        </div>
        <div class="form-group">
            <label for="date_time">Date off the event:</label>
            <input class="form-control" type="text1" autocomplete="off"  placeholder="Enter date when your event will happen" name="date_time" value="">
        </div>
        <label for="category">Category:</label>
        <div class="form-group">
            <select class="form-control" id="exampleFormControlSelect1" name="category">
                <option selected="selected" value="all" class="default">Choose category</option>
                <option value="reality">Reality</option>
                <option value="virtual">Virtual</option>
            </select>
        </div>
        <div class="custom-file">
            <input class="btn btn-outline-danger btn-sm" id="file" style="display: none;"  type="file" name="avatar" value="">
            <input type="button" value="Choose image" class="btn btn-outline-dark btn-sm imagebtn" id="file_alt">
        </div>
        <hr class="my-2">
        <input type="button" class="btn btn-primary btn-lg createbtn"data-toggle="modal" data-target="#exampleModal" value="Create event">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-primary" role="alert">
                            Are you sure you want to create this event?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="createevent-submit" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
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
