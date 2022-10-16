<div class="modal fade mt-5" id="ModalCreateLinkTopicDocument" tabindex="-1" aria-labelledby="ModalCreateLinkTopicDocumentLabel" aria-hidden="true" data-url={{ route('course.topic.store', request()->id) }}>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold text-main" id="ModalCreateLinkTopicDocumentLabel">Thêm liên kết</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" id="frm-create-link-topic-document" method="post" class="row g-3 px-2">
                <div class="col-12">
                    <label for="name-link-document" class="form-label">Tên liên kết (*)</label>
                    <input type="text" class="form-control" id="name-link-document" name="name">
                    <span class="text-danger txt_error txt_name mt-1"></span>
                </div>
                <div class="col-12">
                    <label for="url-link-document" class="form-label">URL liên kết (*)</label>
                    <input class="form-control" id="url-link-document" name="link">
                    <span class="text-danger txt_error txt_link mt-1"></span>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="button" class="btn-sm btn-main btn-store-link-document">Thêm mới</button>
        </div>
      </div>
    </div>
</div>