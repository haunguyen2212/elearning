<div class="modal fade mt-5" id="ModalEdit" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalEditLabel">Chỉnh sửa thông tin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post" class="row g-3 px-2">
            @csrf
                <div class="col-12">
                    <label for="purpose_edit" class="form-label">Mục đích sử dụng (*)</label>
                    <textarea class="form-control" id="purpose_edit" name="purpose_edit" rows="3"></textarea>
                    <span class="text-danger txt_error txt_purpose_edit mt-1"></span>
                </div>

                <div class="col-12 col-md-6">
                    <label for="amount_edit" class="form-label">Số người tham gia (*)</label>
                    <input type="number" class="form-control" name="amount_edit" id="amount_edit" value="">
                    <span class="text-danger txt_error txt_amount_edit mt-1"></span>
                </div>

                <div class="col-12 col-md-6">
                    <label for="date_edit" class="form-label">Ngày sử dụng (*)</label>
                    <input type="text" class="form-control" name="date_edit" id="date_edit" value="" autocomplete="off">
                    <span class="text-danger txt_error txt_date_edit mt-1"></span>
                </div>

                <div class="col-12 col-md-6">
                    <label for="start_time_edit" class="form-label">Thời gian bắt đầu (*)</label>
                    <input type="text" class="form-control" name="start_time_edit" id="start_time_edit" value="" autocomplete="off">
                    <span class="text-danger txt_error txt_start_time_edit mt-1"></span>
                  </div>

                <div class="col-12 col-md-6">
                    <label for="end_time_edit" class="form-label">Thời gian kết thúc (*)</label>
                    <input type="text" class="form-control" name="end_time_edit" id="end_time_edit" value="" autocomplete="off">
                    <span class="text-danger txt_error txt_end_time_edit mt-1"></span>
                  </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-submit">Cập nhật</button>
        </div>
      </div>
    </div>
</div>