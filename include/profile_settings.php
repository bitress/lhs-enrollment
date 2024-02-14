<!-- Modal -->
<div class="modal fade" id="profile_settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form>
        <div class="modal-body">
          
          <!-- Profile Settings Content -->
          <div class="text-center">
            <img class="img-profile rounded-circle" src="img/undraw_profile.svg" style="width: 200px;">
          </div>

          <div class="mt-3 mb-3">
            <input class="form-control text-uppercase text-center" type="text" value="<?php echo $_SESSION['username']; ?>" readonly>
          </div>

          <div class="input-group mb-3">
            <input type="password" class="form-control text-center" value="<?php echo $_SESSION['password']; ?>" readonly>
            <div class="input-group-append">
              <button class="btn btn-secondary" type="button"> <i class="fas fa-lock"></i> </button>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </form>
    </div>
  </div>
</div>