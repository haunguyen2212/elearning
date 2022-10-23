<div class="modal fade mt-5" id="ModalEditExercise" tabindex="-1" aria-labelledby="ModalEditExerciseLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalEditExerciseLabel">Chỉnh sửa bài tập</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-edit-exercise" method="post" enctype="multipart/form-data" class="row g-3 px-2">
                <div class="col-12 col-md-6">
                    <label for="name_exercise_edit" class="form-label">Tên bài tập (*)</label>
                    <input type="text" class="form-control" id="name_exercise_edit" name="name">
                    <span class="text-danger txt_error txt_name mt-1"></span>
                </div>
                <div class="col-12 col-md-6">
                    <label for="expiration_date_exercise_edit" class="form-label">Ngày hết hạn (*)</label>
                    <input class="form-control" id="expiration_date_exercise_edit" name="expiration_date" autocomplete="off">
                    <span class="text-danger txt_error txt_expiration_date mt-1"></span>
                </div>
                <div class="col-12">
                    <label for="content_exercise_edit" class="form-label">Nội dung (*)</label>
                    <textarea class="form-control" id="content_exercise_edit" name="content" rows="3"></textarea>
                    <span class="text-danger txt_error txt_content mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-exercise">Thay đổi</button>
        </div>
      </div>
    </div>
</div>