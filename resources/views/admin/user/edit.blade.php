@extends('layouts.admin')


{{-- ================import css ============= --}}
@section('link_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

{{-- =============import js ==================== --}}
@section('link_js')
    <script src="{{ asset('js/upload.js') }}"></script>
@endsection

{{-- ====================create content --}}
@section('content')
    {!! Form::open(['method' => 'POST','files'=>true, 'url'=>route('user.update',$user->id), 'class' => 'form-horizontal']) !!}
    <div class="col-xl-12 mt-5">
        <h1 >Sửa Thông Tin Thành Viên</h1>
        <div class="btn-group  pull-right">
            {!! Form::submit('Sửa Thông Tin', ['class' => 'btn btn-outline-success fw-bold bg-b']) !!}
            <a href="{{route('user.show')}}" class="btn ms-2 btn-outline-info bg-b">Quay Lại</a>
        </div>
    </div>
    <div class=" row mt-3">
        <div class="col-xl-6">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="fs-4 fw-bold">Họ Và Tên</label>
                {!! Form::text('name', $user->name, ['class' => 'form-control fw-bold bg-b_2', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="fs-4 fw-bold">Địa chỉ Email</label>
                {!! Form::email('email', $user->email, ['class' => 'form-control fw-bold bg-b', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
                <small class="text-danger">{{ $errors->first('email') }}</small>
            </div>
            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                <label for="password" class="fs-4 fw-bold">Ngày Sinh</label>
                {!! Form::date('date', $user->birth_day, ['class' => 'form-control fw-bold bg-b_2', 'required' => 'required']) !!}
                @error('date')
                    <span class="text-danger">( {{ $message }} )</span>
                @enderror
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="password" class="fs-4 fw-bold">Địa Chỉ</label>
                {!! Form::text('address', $user->address, ['class' => 'form-control fw-bold bg-b_3', 'required' => 'required']) !!}
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
                            <option class="fw-bold bg-b" {{ $user->role_id == 1 ? 'selected' : '' }} value="1">Người Quản Trị
                            </option>
                            <option class="fw-bold bg-b" {{ $user->role_id == 2 ? 'selected' : '' }} value="2">Người Dùng Thường
                            </option>
                        </select>
                        <small class="text-danger">{{ $errors->first('role') }}</small>
                    </div>
                    <div class="form-group">
                        <label for="password" class="fs-4 fw-bold">Giới Tính</label>
                        <select name="gender" class="form-select fw-bold bg-b" id="gender">
                            <option value="">----- chọn 1 Giới Tính -----</option>
                            <option {{ $user->gender == 'male' ? 'selected' : '' }} value="male">Nam Giới</option>
                            <option {{ $user->gender == 'female' ? 'selected' : '' }} value="female">Nữ Giới</option>
                            <option {{ $user->gender == 'unsex' ? 'selected' : '' }} value="unsex">Giới Tính Thứ 3</option>
                        </select>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="password" class="fs-4 fw-bold">Số Điện Thoại</label>
                        {!! Form::number('phone', '0' . $user->phone_number, ['class' => 'form-control bg-b_3', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('phone') }}</small>
                    </div>
                </div>
                <div class="col-xl-6">
                    <label for="avata" class="fs-4 fw-bold">Ảnh Đại Diện</label>
                    <small class="text-danger">{{ $errors->first('path_img_thumb') }}</small>
                    <input type='file' id="file" name='img' class="form-control">
                    <div class=" text-center displaynone" id="responseMsg"></div>
                    <div id="result" style="min-height: 300px" class="mt-3 text-center">
                        <img src="{{ $user->avata==null?'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSriFFJXaLLV3g1bFT8PrDRFbD50XjQ7lm_0g&usqp=CAU': url($user->avata)}}" id="thumb_old" style=" width:300px;height:300px; " alt="">
                        <div id="img_show">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
