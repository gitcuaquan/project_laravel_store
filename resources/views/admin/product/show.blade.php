@extends('layouts.admin')
{{-- ================import css ============= --}}
@section('link_css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
{{-- =============import js ==================== --}}
@section('link_js')
@endsection
{{-- ====================create content --}}
@section('content')
    <div class="container">
        <div class="row bg-light pt-5">
            <div class="col-xl-4 ">
                <h1>Danh sách sản phẩm</h1>
            </div>
            <div class="col-xl-4"></div>
            <div class="col-xl-4 d-flex">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="input1"><i class="fas  fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="search" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-2">
            @foreach ($products as $item)
                <div class="col-xl-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ url("{$item->thumnail}") }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">{{ number_format($item->price, 0, ',', '.') }} Đ</p>
                            <a href="{{ url(route('product.edit', $item->id)) }}" class="btn btn-primary">Chỉnh Sửa</a>
                            <a href="{{ url(route('product.delete', $item->id)) }}" class="btn btn-primary">Xóa </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
