@extends('layouts.admin')


{{-- ================import css ============= --}}
@section('link_css')

@endsection

{{-- =============import js ==================== --}}
@section('link_js')

@endsection


{{-- ====================create content --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <h1 class=""> Danh Sách Bài Viết</h1>
            </div>
            <div class="col-xl-4"></div>
            <div class="col-xl-4 d-flex">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="input1"><i class="fas  fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="search" />
                </div>
            </div>
            @if (session('status'))
                <div class="col-xl-12">
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
        <div class="row pt-2 bg-b" style="max-height: 700px;overflow: auto;">
            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="col-xl-6">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4 text-center">
                                    <img src="{{ url($post->thumbnail) }}" style="height: 175px"
                                        class="img-fluid rounded-start mt-2 ms-1" alt="...">
                                    <p class="card-text">
                                    <div class="btn btn-warning"><a class="text-decoration-none text-dark"
                                            href="{{ route('post.edit', ['id' => $post->id]) }}">Sửa Bài Viêt</a></div>
                                    </p>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title" style="height: 27px; overflow: hidden;">{{ $post->title }}
                                        </h5>
                                        <div class="card-text" style="height: 150px;overflow: hidden;">
                                            {!! $post->content !!}</div>
                                        <p class="card-text"><small class="text-muted">Cập Nhật 
                                                {{ $post->updated_at }}</small></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
