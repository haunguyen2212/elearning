<div class="modal fade mt-5" id="ModalCreateTopic" tabindex="-1" aria-labelledby="ModalCreateTopicLabel" aria-hidden="true" data-url={{ route('course.topic.store', request()->id) }}>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalCreateTopicLabel">Thêm chủ đề</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-create-topic" method="post" enctype="multipart/form-data" class="row g-3 px-2">
                <div class="col-12">
                    <label for="title_topic_create" class="form-label">Tên chủ đề (*)</label>
                    <input type="text" class="form-control" id="title_topic_create" name="title">
                    <span class="text-danger txt_error txt_title_topic_create mt-1"></span>
                </div>
                <div class="col-12">
                    <label for="content_topic_create" class="form-label">Nội dung (*)</label>
                    <textarea class="form-control" id="content_topic_create" name="content" rows="3"></textarea>
                    <span class="text-danger txt_error txt_content_topic_create mt-1"></span>
                </div>
                <div class="col-12">
                    <label for="document_topic_create" class="form-label">Tài liệu (*)</label>
                    <input type="file" multiple class="form-control" name="document_topic_create" id="document_topic_create">
                    <span class="text-danger txt_error txt_document_topic_create mt-1"></span>
                  </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-store-topic">Thêm mới</button>
        </div>
      </div>
    </div>
</div>