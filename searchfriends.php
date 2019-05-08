<link rel="stylesheet" href="style/searchusers.style.css">
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="scr/searchfriends.js"></script>
<style>
.search-box1{
    display: block;
    margin-left: auto;
    margin-right: auto;
}
.btn-primary{
  margin-top:100px;
  margin-left:20px;
}
</style>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Make friends!
</button>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Search friends</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="search-box1">
      <input class="search1 nav-item ml-auto" type="text" autocomplete="off" placeholder="Search users..." />
      <div class="result1 dropdown"></div>
    </div>
      </div>
    </div>
  </div>
</div>

