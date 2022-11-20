<!DOCTYPE html>
<html lang="en">

<head>
    <base href="{{ asset('backend') }}/">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="../frontend/assets/css/style.css">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{ route('home') }}">E-learning</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarControll" aria-controls="navbarControll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-between" id="navbarControll">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{ route('home') }}"><span>Trang chủ</span></a>
                  </li>

                  @if (auth()->guard('student')->check())
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('student.score.index') }}"><span>Điểm số</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"><span>Thông báo</span></a>
                    </li>
                  @endif

                  @if (auth()->guard('teacher')->check())
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('teacher.question.index') }}"><span>Trắc nghiệm</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('teacher.registration.create') }}"><span>Đăng ký phòng</span></a>
                    </li>
                  @endif
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.index') }}"><span>Liên hệ</span></a>
                  </li>
                  
                </ul>
                <ul class="navbar-nav ms-auto dropdown" style="position: relative">
                  
                        <button class="btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          <img class="rounded-circle" src="
                          @if (auth()->guard('student')->check())
                            @if (auth()->guard('student')->user()->gender == 0)
                              {{ asset('backend/assets/img/avatar/avatar-student-0.png') }}
                            @else
                              {{ asset('backend/assets/img/avatar/avatar-student-1.png') }}
                            @endif
                          @else
                            @if (auth()->guard('teacher')->user()->gender == 0)
                              {{ asset('backend/assets/img/avatar/avatar-teacher-0.png') }}
                            @else
                              {{ asset('backend/assets/img/avatar/avatar-teacher-1.png') }}
                            @endif
                          @endif
                          " 
                          width="35px" alt="avt">
                          <span>
                            @if (auth()->guard('student')->check())
                              {{ auth()->guard('student')->user()->name }}
                            @else
                              {{ auth()->guard('teacher')->user()->name }}
                            @endif
                          </span> 
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown" style="width: 100%">
                          <li><a class="dropdown-item fw-bold text-main py-2" href="{{ route('profile.index') }}"><i class="bi bi-person"></i>&ensp;Tài khoản</a></li>
                          <li><a class="dropdown-item fw-bold text-main py-2" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i>&ensp;Đăng xuất</a></li>
                        </ul>
                </ul>
              </div>
            </div>
          </nav>
    </header>
  <main>
    <div class="container">

        @yield('content')

    </div>
  </main><!-- End #main -->

  <footer id="footer" class="footer" style="margin-left: 0 !important">
    <div class="copyright">
      <strong><span>Elearning</span></strong> - Hệ thống hỗ trợ dạy và học trực tuyến
    </div>
    <div class="credits">Hỗ trợ: contact172837@gmail.com
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>