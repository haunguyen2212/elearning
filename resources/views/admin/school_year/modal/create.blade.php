<div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalCreateLabel">Thêm năm học mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-create" data-url="{{ route('school_year.store') }}">
            <div class="row p-2">
              <div class="col-12 pt-2">
                  <label for="name_create" class="form-label">Năm học (*)</label>
                  <input type="text" class="form-control" id="name_create" name="name">
                  <span class="text-danger mt-3 err-name"></span>
              </div>
  
              <div class="col-12 col-md-6 pt-2">
                  <label for="start_time" class="form-label">Ngày bắt đầu (*)</label>
                  <input type="text" class="form-control" name="start_time" id="start_time_create" value="" autocomplete="off">
                  <span class="text-danger mt-3 err-start_time"></span>
                </div>
  
              <div class="col-12 col-md-6 pt-2">
                  <label for="end_time" class="form-label">Ngày kết thúc (*)</label>
                  <input type="text" class="form-control" name="end_time" id="end_time_create" value="" autocomplete="off">
                  <span class="text-danger mt-3 err-end_time"></span>
              </div>
  
              <div class="col-12 pt-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="status" value="1" id="status_create">
                  <label class="form-check-label" for="status_create">
                    Đặt làm học kỳ hiện tại
                  </label>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn btn-sm btn-primary btn-create-submit">Thêm mới</button>
        </div>
      </div>
    </div>
</div>