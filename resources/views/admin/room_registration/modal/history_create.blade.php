<!-- Modal -->
<div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="ModalCreateLabel" aria-hidden="true" data-url="{{ route('schedule_edit.store') }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-main fw-bold" id="ModalCreateLabel">Thêm mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row p-2">
            <div class="col-12 pt-2">
                <label for="purpose" class="form-label">Mục đích sử dụng (*)</label>
                <textarea type="text" class="form-control" id="purpose_create" name="purpose" rows="3"></textarea>
                <span class="text-danger mt-3 err-purpose"></span>
            </div>

            <div class="col-12 col-md-6 pt-2">
                <label for="teacher_id" class="form-label">Tên giáo viên (*)</label>
                <select class="form-select" id="teacher_id_create" name="teacher_id">
                    <option selected>Chọn tên giáo viên</option>
                </select>
                <span class="text-danger mt-3 err-teacher_id"></span>
            </div>

            <div class="col-12 col-md-6 pt-2">
                <label for="amount" class="form-label">Số người tham gia (*)</label>
                <input type="number" class="form-control" name="amount" id="amount_create" value="">
                <span class="text-danger mt-3 err-amount"></span>
            </div>

            <input type="hidden" class="form-control" name="date" id="date_create" value="">
            <input type="hidden" class="form-control" name="room_id" id="room_id_create" value="">

            <div class="col-12 col-md-6 pt-2">
                <label for="start_time" class="form-label">Thời gian bắt đầu (*)</label>
                <input type="text" class="form-control" name="start_time" id="start_time_create" value="" autocomplete="off">
                <span class="text-danger mt-3 err-start_time"></span>
              </div>

            <div class="col-12 col-md-6 pt-2">
                <label for="end_time" class="form-label">Thời gian kết thúc (*)</label>
                <input type="text" class="form-control" name="end_time" id="end_time_create" value="" autocomplete="off">
                <span class="text-danger mt-3 err-end_time"></span>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-sm btn-primary sm-create">Thêm mới</button>
        </div>
      </div>
    </div>
</div>