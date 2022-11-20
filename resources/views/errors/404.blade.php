@extends('template.error')

@section('title', '403 / Forbidden')

@section('content')
  <section class="section error-404 d-flex flex-column justify-content-center text-center" style="min-height: 75vh">
    <h1 class="">404</h1>
    <h2 class="pt-2">Không tìm thấy đường dẫn này.</h2>
    <div class="d-flex justify-content-center">
      <a class="btn" href="{{ route('home') }}" style="max-width: 200px">VỀ TRANG CHỦ</a>
    </div>
    
  </section>
@endsection