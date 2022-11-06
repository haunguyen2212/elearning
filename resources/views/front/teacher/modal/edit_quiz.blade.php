<div class="modal fade mt-5" id="ModalEditQuiz" tabindex="-1" aria-labelledby="ModalEditQuizLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalEditQuizLabel">Chỉnh sửa bài thi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-edit-quiz" method="post"  class="row g-3 px-2">
                <div class="col-12 col-md-12">
                    <label for="name_quiz_edit" class="form-label">Tên bài thi (*)</label>
                    <input type="text" class="form-control" id="name_quiz_edit" name="name">
                    <span class="text-danger txt_error txt_name mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="start_time_quiz_edit" class="form-label">Thời gian mở đề (*)</label>
                    <input class="form-control" id="start_time_quiz_edit" name="start_time" autocomplete="off">
                    <span class="text-danger txt_error txt_start_time mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="end_time_quiz_edit" class="form-label">Thời gian đóng đề (*)</label>
                    <input class="form-control" id="end_time_quiz_edit" name="end_time" autocomplete="off">
                    <span class="text-danger txt_error txt_end_time mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label for="duration_quiz_edit" class="form-label">Thời gian làm bài (phút) (*)</label>
                  <input type="number" class="form-control" id="duration_quiz_edit" name="duration">
                  <span class="text-danger txt_error txt_duration mt-1"></span>
              </div>
                <div class="col-12 col-md-6">
                    <label for="password_quiz_edit" class="form-label">Mật khẩu bài thi (*)</label>
                    <input class="form-control" id="password_quiz_edit" name="password">
                    <span class="text-danger txt_error txt_password mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-quiz">Cập nhật</button>
        </div>
      </div>
    </div>
</div>