<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/groups.style.css">
<div class="container">
<h1 id="title_groups"><b>Groups</b></h1>
<button data-toggle="modal" data-target="#creategroupModal" id="creategroup_btn" class="btn btn-primary">Create group</button>
<div class="modal fade" id="creategroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="scr/creategroup.scr.php" method="post" novalidate>
        <input id="title" value="" type="text" class="form-control" name="group_name" aria-describedby="title" placeholder="Name of a group" autocomplete="off" onkeyup="javascript:capitalize(this.id, this.value);" maxlength="15" required>      
        <small class="form-text text-muted">More settings after you create the group!</small>
      </div>
      <div class="modal-footer">
      <button  class="btn btn-success center-block" name="creategroup-submit" id="create_groupbtn" type="submit">Create Group</button>
      </form>
      </div>
    </div>
  </div>
</div>
<div>
<hr>
<?php require 'grouptab.php' ?>
<?php require 'footer.php' ?>