<div class="modal fade mt-5" id="ModalEditCourseNotice" tabindex="-1" aria-labelledby="ModalEditCourseNoticeLabel" aria-hidden="true" data-url={{ route('course.topic.store', request()->id) }}>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalEditCourseNoticeLabel">Cập nhật thông báo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-edit-course-notice" method="post" class="row g-3 px-2">
                <div class="col-12">
                    <label for="content_course_notice_edit" class="form-label">Nội dung (*)</label>
                    <textarea class="form-control" id="content_course_notice_edit" name="notice" rows="3">
                        {!! old('notice', $course->notice) !!}
                    </textarea>
                    <span class="text-danger txt_error txt_notice mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-course-notice">Cập nhật</button>
        </div>
      </div>
    </div>
</div>