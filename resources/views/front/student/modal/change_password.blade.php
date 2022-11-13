<div class="modal fade mt-5" id="ModalChangePassword" tabindex="-1" aria-labelledby="ModalChangePasswordLabel" aria-hidden="true" data-url="{{ route('student.profile.change_password') }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalChangePasswordLabel">Đổi mật khẩu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-change-password" method="post" class="row g-3 px-2">
                <div class="col-12 col-md-12">
                    <label for="current_password" class="form-label">Mật khẩu hiện tại (*)</label>
                    <input type="password" class="form-control" id="current_password" name="current_password">
                    <span class="text-danger txt_error txt_current_password mt-1"></span>
                </div>
                <div class="col-12 col-md-12">
                    <label for="new_password" class="form-label">Mật khẩu mới (*)</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                    <span class="text-danger txt_error txt_new_password mt-1"></span>
                </div>
                <div class="col-12 col-md-12">
                    <label for="confirm_password" class="form-label">Nhập lại mật khẩu mới (*)</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    <span class="text-danger txt_error txt_confirm_password mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-password">Thay đổi</button>
        </div>
      </div>
    </div>
</div>