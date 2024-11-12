<!-- Modal For Add faculty -->
<div class="modal fade" id="modalfaculty">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Add Faculty</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../admin/query/addCourseExe.php" class="refreshFrm" id="formfaculty" method="POST">
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Faculty Name</label>
              <input type="" name="fname" id="fname" class="form-control" placeholder="Input Course" required="" autocomplete="off">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="close"><span aria-hidden="true">Close</span></button>
        <button type="submit" name="addfaculty" id="addfacult" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>