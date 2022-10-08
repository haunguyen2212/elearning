<div class="modal fade mt-5" id="ModalEditTopic" tabindex="-1" aria-labelledby="ModalEditTopicLabel" aria-hidden="true" data-url={{ route('course.topic.store', request()->id) }}>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalEditTopicLabel">Cập nhật chủ đề</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-edit-topic" method="post" enctype="multipart/form-data" class="row g-3 px-2">
                <div class="col-12">
                    <label for="title_topic_edit" class="form-label">Tên chủ đề (*)</label>
                    <input type="text" class="form-control" id="title_topic_edit" name="title">
                    <span class="text-danger txt_error txt_title mt-1"></span>
                </div>
                <div class="col-12">
                    <label for="content_topic_edit" class="form-label">Nội dung (*)</label>
                    <textarea class="form-control" id="content_topic_edit" name="content" rows="3"></textarea>
                    <span class="text-danger txt_error txt_content mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-update-topic">Cập nhật</button>
        </div>
      </div>
    </div>
</div>