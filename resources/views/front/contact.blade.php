@extends('template.master_layout')

@section('title', 'Liên hệ')

@section('breadcrumb')
    <li class="breadcrumb-item active">Liên hệ</li>
@endsection

@section('content')
<div class="card main-card">
    <div class="card-body px-4">
        <div class="card-title mb-0">Liên hệ</div>
        <div class="card-content">
            Mọi chi tiết vui lòng liên hệ với 1 trong các email bên dưới:
        </div>
        <ul>
            @foreach ($admins as $admin)
                <li>+ <a href="mailto:{{ $admin->email }}">{{ $admin->email }}</a>{{ ' - '. $admin->name }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection