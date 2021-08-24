@extends('layouts.admin')


{{-- ================import css ============= --}}
@section('link_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

@endsection

{{-- =============import js ==================== --}}
@section('link_js')
    <script src="{{ asset('js/search.js') }}"></script>

@endsection


{{-- ====================create content --}}
@section('content')
    <div class="container">
        <div class="row border-ct-1">
            <div class="col-xl-5">
                <h1 class="mt-3"> Danh Sách Thành Viên</h1>
            </div>
            <div class="col-xl-3"></div>
            <div class="col-xl-4 d-flex">
                <div class="input-group ">
                    <input type="text" id="search" class="form-control mt-3 bg-b fs-4 " style="height: 40px"
                        placeholder="search" />
                    <div id="result-search" class="d-play">

                    </div>
                </div>
            </div>
            @if (session('status'))
                <div class="col-xl-12">
                    <div class="alert alert-success">
                        <h2>{!! session('status') !!}</h2>
                    </div>
                </div>
            @endif
            @if (session('err'))
                <div class="col-xl-12">
                    <div class="alert alert-danger">
                        <h2>{!! session('err') !!}</h2>
                    </div>
                </div>
            @endif
        </div>
        <div class="row border-ct-2 py-2">
            <div class="col-xl-3">
                <a href="{{ route('user.add') }}" class="btn btn-outline-add bg-b_2 fw-bold ">
                    <i class="fas pe-2 fs-4  fa-user-plus"></i>
                    Thêm Thành Viên Ngay</a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('user.add') }}" class="btn btn-outline-add bg-b_2 fw-bold ">
                    <i class="fas pe-2 fs-4 fa-user-secret"></i>
                    Thành Viên Chưa Xác Nhận ({{$count_not_auth}})</a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('user.add') }}" class="btn btn-outline-add bg-b_2 fw-bold ">

                    <i class="fas pe-2 fs-4 fa-user-check"></i>
                    Thành Viên Đã Xác Nhận ({{$count_auth}})</a>
            </div>
            <div class="col-xl-3">
                <a href="{{ route('user.add') }}" class="btn btn-outline-add bg-b_2 fw-bold ">
                    <i class="fas pe-2 fs-4 fa-user-cog"></i>
                    NGười Quản Trị ({{$count_adimn}})</a>
            </div>
        </div>
        <div class="row mt-4" style="max-height: 700px;min-height: 700px;overflow: auto;">
            <div class="tableFixHead">
                <table>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Thành Viên</th>
                            <th>Email Đăng Nhập</th>
                            <th>Tình Trang Xác Thực</th>
                            <th>Quyền Thành Viên</th>
                            <th>Ngày Vào Hệ Thống</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    @php
                        $t = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tbody>
                            <tr class="{{ (int) $t % 2 == 0 ? 'bg-1' : 'bg-2' }}">
                                <td>{{ $t++ }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><?php if (!empty($user->email_verified_at)) {
                                    echo 'Xác Nhận Hoàn Tất';
                                } else {
                                    echo 'Chưa Xác Nhận';
                                } ?></td>
                                <td>{{ $user->role_id == 1 ? 'Người Quản Trị' : 'Người Dùng Thường' }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-warning"><i
                                            class="fas fa-user-edit"></i></a>
                                    @if (Auth::id() != $user->id)
                                        <a href="{{ route('user.delete', ['id' => $user->id]) }}"
                                            class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    @endsection
