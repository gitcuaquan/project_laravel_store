@extends('layouts.admin')


{{-- ================import css ============= --}}
@section('link_css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/post.css') }}">
@endsection

{{-- =============import js ==================== --}}
@section('link_js')
    <script src="https://cdn.tiny.cloud/1/n269irwmtd5734p6eg9fdgw63925a1tpn9eo272v41s5yscs/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('js/post.js') }}"></script>
@endsection

{{-- ====================create content --}}
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        <h4>{{session('status')}}</h4>
    </div>
@endif
    <div class="row ">
        <div class="col-12">
            <h1 class="text-center ">Thêm Bài Viết</h1>
        </div>
    </div>
    <div class="row ">
        {!! Form::open(['method' => 'POST', 'route' => 'post.create', 'class' => 'form-horizontal']) !!}

        <div class="col-xl-12">
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', 'Tiêu Đề Bài Viết') !!}
                {!! Form::text('title', null, ['class' => 'form-control bg-b', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-6 bg-b">
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    {!! Form::label('content', 'Chi Tiết Bài Viết') !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control ', 'id' => 'tiny']) !!}
                    <small class="text-danger">{{ $errors->first('content') }}</small>
                </div>
            </div>
            <div class="col-xl-1"></div>
            <div class="col-xl-5 bg-b ">
                <h3>Ảnh Đại Diện Bài Viết</h3>
                <div  style="height: 480px">
                    <input type='file' id="file" name='file' class="form-control">
                    <div class=" text-center displaynone" id="responseMsg"></div>
                    <div id="result" style="min-height: 300px" class="mt-3 text-center">
                        <img src="" alt="" style="width:300px;height: 300px; display: none;" class="img-fluid">
                        <input type="hidden" name="path_img_thumb" id="path_img">
                        <div id="link_images">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Thêm Bài Viết', ['class' => 'btn btn-success mt-4']) !!}
        {!! Form::close() !!}
    </div>
@endsection
