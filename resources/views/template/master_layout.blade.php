<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('frontend')}}/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="../backend/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../backend/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    @yield('style')
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
                      <a class="nav-link" href="#"><span>Điểm số</span></a>
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
                    <a class="nav-link" href="#"><span>Liên hệ</span></a>
                  </li>
                  
                </ul>
                <ul class="navbar-nav ms-auto dropdown">
                  
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
                        <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                          <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                        </ul>
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <div class="container" style="min-height: 650px">

      <div class="pagetitle">
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
            @yield('breadcrumb')
          </ol>
        </nav>
      </div>

      <div class="wrapper">
        <div class="row">
            <div class="col-12 col-md-8">
              @yield('content')              
            </div>
              <div class="col-12 col-md-4">
                <div class="row">

                  @if (auth()->guard('teacher')->check())

                  @yield('right')
                    
                    @if (isset($myTeacherCourses))
                        <div class="col-12">
                          <div class="card">
                            <div class="card-body pb-0">
                              <h5 class="card-title">Khóa học của tôi</h5>
                              <ul class="list-item ps-0">
                                @foreach ($myTeacherCourses as $myCourse)
                                  <li>
                                    <a href="{{ route('course.view.teacher',$myCourse->id) }}"><i class="bi bi-caret-right"></i> {{ $myCourse->code .' - '. $myCourse->name }}</a>
                                  </li>
                                @endforeach
                              </ul> 
                            </div>
                          </div>
                        </div>
                      @endif

                  @endif

                  @if (auth()->guard('student')->check())

                    @if (isset($myStudentCourses))
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body pb-0">
                            <h5 class="card-title">Khóa học của tôi</h5>
                            <ul class="list-item ps-1">
                              @foreach ($myStudentCourses as $myCourse)
                                <li>
                                  <a href="{{ route('course.view.student', $myCourse->course_id) }}"><i class="bi bi-caret-right-fill"></i> {{ $myCourse->code .' - '. $myCourse->course_name }}</a>
                                </li>
                              @endforeach
                            </ul> 
                          </div>
                        </div>
                      </div>
                    @endif
                  @endif

                    @if (isset($notices))
                      <div class="col-12">
                        <div class="card">
                          <div class="card-body pt-0">
                            <h5 class="card-title">Thông báo</h5>
                            <ul class="list-item ps-1">
                              @foreach ($notices as $key => $notice)
                                <li>
                                  <a href="{{ asset('backend/assets/document/notices/'.$notice->link) }}"> {{ $key+1 .'. '. ($notice->name ?? $notice->link) }}</a>
                                </li>
                              @endforeach
                            </ul>
                          </div>
                        </div>
                      </div>
                    @endif
                  
                  
                </div>
                
              </div>
            </div>
        
      </div>

    </div>

    <footer id="footer" class="footer">
      <div class="copyright">
        <strong><span>Elearning</span></strong> - Hệ thống hỗ trợ dạy và học trực tuyến
      </div>
      <div class="credits">Hỗ trợ: contact172837@gmail.com
      </div>
    </footer>

    <script src="../backend/assets/js/jquery.min.js"></script>
    <script src="../backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../function.js"></script>
    <script>
      var _token = $('meta[name="csrf-token"]').attr('content');
    </script>
    @yield('script')
</body>
</html>