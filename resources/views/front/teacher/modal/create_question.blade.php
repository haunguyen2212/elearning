<!-- Modal -->
<div class="modal fade" id="ModalCreateQuestion" tabindex="-1" aria-labelledby="ModalCreateQuestionLabel" aria-hidden="true" data-url="{{ route('question.create') }}">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-main fw-bold" id="ModalCreateQuestionLabel">Thêm mới câu hỏi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="frm-create" action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row p-2">
                    <div class="col-12 pt-2">
                        <label for="question_create" class="form-label fw-bold text-main">Nội dung câu hỏi (*)</label>
                        <textarea class="form-control" id="question_create" name="question"></textarea>
                        <span class="text-danger mt-3 err-question"></span>
                    </div>

                    <div class="col-12 col-md-12 pt-2">
                        <label for="image_create" class="form-label fw-bold text-main">Hình ảnh</label>
                        <input class="form-control" type="file" name="image" id="image_create" onchange="showImageUpload(this,'.image-question-create')" accept="image/png, image/jpeg" style="display: none">
                        <br><button type="button" class="btn btn-sm btn-main" onclick="uploadImage('#image_create')">Chọn hình ảnh</button>
                        <div>
                          <img class="image-question-create" alt="img" width="200px" style="display: none">
                        </div>
                        <span class="text-danger mt-3 err-image"></span>
                    </div>
        
                    <div class="col-12 col-md-6 pt-2">
                        <label for="answer_a_create" class="form-label fw-bold text-main">Đáp án A (*)</label>
                        <textarea class="form-control" name="answer_a" id="answer_a_create" value=""></textarea>
                        <span class="text-danger mt-3 err-answer_a"></span>
                    </div>
        
                    <div class="col-12 col-md-6 pt-2">
                        <label for="answer_b_create" class="form-label fw-bold text-main">Đáp án B (*)</label>
                        <textarea class="form-control" name="answer_b" id="answer_b_create" value=""></textarea>
                        <span class="text-danger mt-3 err-answer_b"></span>
                    </div>
        
                    <div class="col-12 col-md-6 pt-2">
                        <label for="answer_c_create" class="form-label fw-bold text-main">Đáp án C</label>
                        <textarea class="form-control" name="answer_c" id="answer_c_create" value=""></textarea>
                        <span class="text-danger mt-3 err-answer_c"></span>
                    </div>
        
                    <div class="col-12 col-md-6 pt-2">
                        <label for="answer_d_create" class="form-label fw-bold text-main">Đáp án D</label>
                        <textarea class="form-control" name="answer_d" id="answer_d_create" value=""></textarea>
                        <span class="text-danger mt-3 err-answer_d"></span>
                    </div>
        
                    <div class="col-12 pt-2">
                        <label for="explain_create" class="form-label fw-bold text-main">Giải thích đáp án</label>
                        <textarea class="form-control" name="explain" id="explain_create" value=""></textarea>
                        <span class="text-danger mt-3 err-explain"></span>
                    </div>
        
                    <div class="col-12 col-md-4 pt-2">
                        <label for="" class="form-label fw-bold text-main">Đáp án đúng (*)</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer1" value="1">
                            <label class="form-check-label" for="correct_answer1">A</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer2" value="2">
                            <label class="form-check-label" for="correct_answer2">B</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer3" value="3" >
                            <label class="form-check-label" for="correct_answer3">C</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="correct_answer" id="correct_answer4" value="4" >
                            <label class="form-check-label" for="correct_answer4">D</label>
                          </div>
                          <br><span class="text-danger mt-3 err-correct_answer"></span>
                    </div>
                    
        
                    <div class="col-12 col-md-4 pt-2">
                        <label for="" class="form-label fw-bold text-main">Cấp độ câu hỏi (*)</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="level1" value="1" checked>
                            <label class="form-check-label" for="level1">
                              Dễ
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="level2" value="2">
                            <label class="form-check-label" for="level2">
                              Trung bình
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="level" id="level3" value="3">
                            <label class="form-check-label" for="level3">
                              Khó
                            </label>
                        </div>
                        <br><span class="text-danger mt-3 err-level"></span>
                    </div>
                    <div class="col-12 col-md-4 pt-2">
                        <label for="" class="form-label fw-bold text-main">Loại câu hỏi (*)</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shared" id="shared1" value="1" checked>
                            <label class="form-check-label" for="shared1">Chung</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="shared" id="shared0" value="0">
                            <label class="form-check-label" for="shared0">Riêng</label>
                        </div>
                        <br><span class="text-danger mt-3 err-shared"></span>
                    </div>
                </div>
            </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Hủy</button>
          <button type="button" class="btn btn-sm btn-primary sm-create">Thêm mới</button>
        </div>
      </div>
    </div>
</div>
</div>