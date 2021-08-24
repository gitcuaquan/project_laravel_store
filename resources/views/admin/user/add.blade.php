@extends('layouts.admin')


{{-- ================import css ============= --}}
@section('link_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

{{-- =============import js ==================== --}}
@section('link_js')
    <script src="{{ asset('js/user.js') }}"></script>
@endsection


{{-- ====================create content --}}
@section('content')
    <div class="row ">
        <div class="col-xl-12 fw-bold bg-light bg-b">
            <h1> Thêm Người Dùng</h1>
        </div>
        <div class="col-xl-12">
            {!! Form::open(['method' => 'POST', 'route' => 'user.add', 'class' => 'form-horizontal']) !!}
            <div class="col-xl-12 mt-5">
                <div class="btn-group  pull-right">
                    {!! Form::submit('Thêm Thành Viên', ['class' => 'btn btn-outline-success fw-bold bg-b']) !!}
                </div>
            </div>
            <div class=" row mt-3">
                <div class="col-xl-6">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="fs-4 fw-bold">Họ Và Tên</label>
                        {!! Form::text('name', null, ['class' => 'form-control fw-bold bg-b_2', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="fs-4 fw-bold">Địa chỉ Email</label>
                        {!! Form::email('email', null, ['class' => 'form-control fw-bold bg-b', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
                        <small class="text-danger">{{ $errors->first('email') }}</small>
                    </div>
                    <div class"form-group {{ $errors->has('password') ? ' has-error' : '' }} ">
                            <label for=" password" class="fs-4 fw-bold">Mật Khẩu</label>
                        {!! Form::password('password', ['class' => 'form-control fw-bold bg-b_3', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('password') }}</small>
                    </div>
                    <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                        <label for="password" class="fs-4 fw-bold">Ngày Sinh</label>
                        {!! Form::date('date', null, ['class' => 'form-control fw-bold bg-b_2', 'required' => 'required']) !!}
                        @error('date')
                            <span class="text-danger">( {{ $message }} )</span>
                        @enderror
                    </div>
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="password" class="fs-4 fw-bold">Địa Chỉ</label>
                        {!! Form::text('address', null, ['class' => 'form-control fw-bold bg-b_3', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('address') }}</small>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="password" class="fs-4 fw-bold">Quền Truy Cập</label>
                                <select name="role" class="form-select fw-bold bg-b" id="role">
                                    <option class="fw-bold bg-b" value="">----- chọn 1 phân quyền -----</option>
                                    <option class="fw-bold bg-b" value="1">Người Quản Trị</option>
                                    <option class="fw-bold bg-b" value="2">Người Dùng Thường</option>
                                </select>
                                <small class="text-danger">{{ $errors->first('role') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="password" class="fs-4 fw-bold">Giới Tính</label>
                                <select name="gender" class="form-select fw-bold bg-b" id="gender">
                                    <option value="">----- chọn 1 Giới Tính -----</option>
                                    <option value="male">Nam Giới</option>
                                    <option value="female">Nữ Giới</option>
                                    <option value="unsex">Giới Tính Thứ 3</option>
                                </select>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="password" class="fs-4 fw-bold">Số Điện Thoại</label>
                                {!! Form::number('phone', null, ['class' => 'form-control bg-b_3', 'required' => 'required']) !!}
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <label for="avata" class="fs-4 fw-bold">Ảnh Đại Diện</label>
                            <small class="text-danger">{{ $errors->first('path_img_thumb') }}</small>
                            <form action="" method="post">
                                <input type='file' id="file" name='file' class="form-control bg-b_2">
                                <div class=" mt-2 text-center displaynone" id="responseMsg"></div>
                                <div id="result" style="min-height: 280px" class="mt-3 text-center">
                                    <img src="" alt="" style="width:300px;height: 300px; display: none;" class="img-fluid">
                                    <input type="hidden" name="path_img_thumb" id="path_img">
                                    <div id="link_images">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
