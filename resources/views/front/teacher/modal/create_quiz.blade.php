<div class="modal fade mt-5" id="ModalCreateQuiz" tabindex="-1" aria-labelledby="ModalCreateQuizLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalCreateQuizLabel">Thêm bài thi trắc nghiệm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-create-quiz" method="post"  class="row g-3 px-2">
                <div class="col-12 col-md-12">
                    <label for="name_quiz_create" class="form-label">Tên bài thi (*)</label>
                    <input type="text" class="form-control" id="name_quiz_create" name="name">
                    <span class="text-danger txt_error txt_name mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="start_time_quiz_create" class="form-label">Thời gian mở đề (*)</label>
                    <input class="form-control" id="start_time_quiz_create" name="start_time" autocomplete="off">
                    <span class="text-danger txt_error txt_start_time mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="end_time_quiz_create" class="form-label">Thời gian đóng đề (*)</label>
                    <input class="form-control" id="end_time_quiz_create" name="end_time" autocomplete="off">
                    <span class="text-danger txt_error txt_end_time mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                  <label for="duration_quiz_create" class="form-label">Thời gian làm bài (phút) (*)</label>
                  <input type="number" class="form-control" id="duration_quiz_create" name="duration">
                  <span class="text-danger txt_error txt_duration mt-1"></span>
              </div>
                <div class="col-12 col-md-6">
                    <label for="password_quiz_create" class="form-label">Mật khẩu bài thi (*)</label>
                    <input class="form-control" id="password_quiz_create" name="password">
                    <span class="text-danger txt_error txt_password mt-1"></span>
                </div>
                <div class="col-12 col-md-12">
                  <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="is_show" id="is_show1" value="1">
                      <label class="form-check-label" for="is_show1">Hiển thị bài thi</label>
                  </div>
                  <br><span class="text-danger mt-3 err-is_show"></span>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-store-quiz">Thêm mới</button>
        </div>
      </div>
    </div>
</div>