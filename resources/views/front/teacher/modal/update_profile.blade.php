<div class="modal fade mt-5" id="ModalEditProfile" tabindex="-1" aria-labelledby="ModalEditProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalEditProfileLabel">Chỉnh sửa thông tin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-edit-profile" method="post" class="row g-3 px-2">
                <div class="col-12 col-md-6">
                    <label for="name_edit" class="form-label">Họ và tên (*)</label>
                    <input type="text" class="form-control" id="name_edit" name="name">
                    <span class="text-danger txt_error txt_name mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="" class="form-label fw-bold text-main">Giới tính (*)</label> <br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1" value="1" checked>
                        <label class="form-check-label" for="gender1">
                          Nữ
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender0" value="0">
                        <label class="form-check-label" for="gender0">
                          Nam
                        </label>
                    </div>
                    <br><span class="text-danger mt-3 err-gender"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="date_of_birth_edit" class="form-label">Ngày sinh (*)</label>
                    <input type="text" class="form-control" id="date_of_birth_edit" name="date_of_birth">
                    <span class="text-danger txt_error txt_date_of_birth mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="address_edit" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address_edit" name="address">
                    <span class="text-danger txt_error txt_address mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="phone_edit" class="form-label">Điện thoại</label>
                    <input type="text" class="form-control" id="phone_edit" name="phone">
                    <span class="text-danger txt_error txt_phone mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="email_edit" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email_edit" name="email">
                    <span class="text-danger txt_error txt_email mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-profile">Thay đổi</button>
        </div>
      </div>
    </div>
</div>