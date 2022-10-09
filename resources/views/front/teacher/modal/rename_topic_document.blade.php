<div class="modal fade mt-5" id="ModalRenameTopicDocument" tabindex="-1" aria-labelledby="ModalRenameTopicDocumentLabel" aria-hidden="true" data-url={{ route('course.topic.store', request()->id) }}>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalRenameTopicDocumentLabel">Đổi tên tài liệu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-rename-topic-document" method="post" class="row g-3 px-2">
                <div class="col-12">
                    <label for="title_topic_document_rename" class="form-label">Tên tài liệu (*)</label>
                    <input type="text" class="form-control" id="title_topic_document_rename" name="name">
                    <span class="text-danger txt_error txt_name mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-topic-document">Cập nhật</button>
        </div>
      </div>
    </div>
</div>