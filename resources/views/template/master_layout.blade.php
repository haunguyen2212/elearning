<!DOCTYPE html>
<html lang="en">
<head>
    <base href="{{asset('frontend')}}/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
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
              <a class="navbar-brand" href="#">E-learning</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarControll" aria-controls="navbarControll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-between" id="navbarControll">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><span>Trang chủ</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"><span>Lớp học</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"><span>Điểm số</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#"><span>Phòng thực hành</span></a>
                  </li>
                </ul>
                <ul class="navbar-nav ms-auto dropdown">
                  
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          <img class="rounded-circle" src="http://127.0.0.1:8000/backend/assets/img/profile-img.jpg" width="35px" alt="avt">
                          <span>Nguyễn Trung Hậu</span> 
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
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
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body pb-0">
                        <h5 class="card-title">Khóa học của tôi</h5>
                        <ul class="list-item">
                          <li>
                            <a href=""><i class="bi bi-caret-right-fill"></i> CT174 - Toán 12 (Võ Huỳnh Trâm) </a>
                          </li>
                          <li>
                            <a href=""><i class="bi bi-caret-right-fill"></i> CT174 - Toán 12 (Võ Huỳnh Trâm) </a>
                          </li>
                        </ul> 
                      </div>
                    </div>
                    
                  </div>
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body pt-0">
                        <h5 class="card-title">Thông báo</h5>
                      </div>
                    </div>
                    
                  </div>
                </div>
                
              </div>
            </div>
        
      </div>

    </div>

    <footer id="footer" class="footer">
      <div class="copyright">
        <span>Elearning</span></strong> - Hệ thống hỗ trợ dạy và học trực tuyến
      </div>
      <div class="credits">Hỗ trợ: contact172837@gmail.com
      </div>
    </footer>

    <script src="../backend/assets/js/jquery.min.js"></script>
    <script src="../backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>
</html>