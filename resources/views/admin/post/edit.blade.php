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
    <script src="{{ asset('js/upload.js') }}"></script>
@endsection


{{-- ====================create content --}}
@section('content')
    <div class="row ">
        <div class="col-12">
            <h1 class="text-center ">Thêm Bài Viết</h1>
        </div>
    </div>
    <div class="row ">
        {!! Form::open(['method' => 'POST','files'=>true, 'url' => route('post.update',['id'=>$post->id]), 'class' => 'form-horizontal']) !!}

        <div class="col-xl-12">
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', 'Tiêu Đề Bài Viết') !!}
                {!! Form::text('title', $post->title, ['class' => 'form-control bg-b', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-xl-6 bg-b">
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    {!! Form::label('content', 'Chi Tiết Bài Viết') !!}
                    {!! Form::textarea('content', $post->content, ['class' => 'form-control ', 'id' => 'tiny']) !!}
                    <small class="text-danger">{{ $errors->first('content') }}</small>
                </div>
            </div>
            <div class="col-xl-1"></div>
            <div class="col-xl-5 bg-b ">
                <p>Ảnh Đại Diện Bài Viết</p>
                <input type='file' id="file" name='img' class="form-control">
                <div class=" text-center displaynone" id="responseMsg"></div>
                <div id="result" style="min-height: 300px" class="mt-3 text-center">
                    <img src="{{ url($post->thumbnail) }}" id="thumb_old" style=" width:300px;height:300px; " alt="">
                    <div id="img_show">
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Sửa Bài Viết', ['class' => 'btn btn-warning mt-4']) !!}
        <a href="{{ route('post.delete', ['id'=>$post->id]) }}" class="btn btn-danger mt-4"> Xóa Bài Viết</a>
        {!! Form::close() !!}
    </div>
@endsection
