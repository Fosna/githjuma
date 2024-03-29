<?php require 'settings_modal.php'; ?>
<?php require 'header.php'; ?>
<?php require 'scr/count_joined_groups.scr.php'; ?>
<link rel="stylesheet" href="style/groups.style.css">
<div class="container">
<h1 id="title_groups"><b>Groups</b></h1>
<?php if($numberOfJoinedGroups == 5){ ?>
  <h6 id="max_groups_txt2">You can only join/create 5 groups</h6>
<?php
}else{ ?>
<button data-toggle="modal" data-target="#creategroupModal" id="creategroup_btn" class="btn btn-dark">Create group</button>
<?php } ?>
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
        <input id="description" value="" type="text" class="form-control" name="group_description" aria-describedby="title" placeholder="Description" autocomplete="off" onkeyup="javascript:capitalize(this.id, this.value);" maxlength="100" required>           
        <label class="my-1 mr-2" id="text_modal" for="inlineFormCustomSelectPref">Main programming language</label>
      <select  class="custom-select my-1 mr-sm-2" name="main_prog_language" id="input_select">
        <option value="Python">Python</option>
        <option value="JavaScript">JavaScript</option>
        <option value="PHP">PHP</option>
      </select>
      </div>
      <div class="modal-footer">
      <button  class="btn btn-dark btn-block btn-lg" name="creategroup-submit" id="create_groupbtn" type="submit">Create Group</button>
      </form>
      </div>
    </div>
  </div>
</div>
<div>
<hr>
<?php require 'grouptab.php' ?>
<?php require 'footer.php' ?>
<script>
// Material Select Initialization
$(document).ready(function() {
$('.mdb-select').materialSelect();
});
</script>