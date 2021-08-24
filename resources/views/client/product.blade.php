@extends('layouts.client')

@section('title')
    Trang Sản Phẩm
@endsection


@section('link_css')
    <link rel="stylesheet" href="{{ asset('css/client_css/product.css') }}">
@endsection


@section('link_js')
    {{-- <script src="{{ asset('js/client_js/home.js') }}"></script> --}}
@endsection

@section('content')
    <div style="min-height: 800px" class="container pt-5">
        <div class="row py-5">
            <div class="col-xl-10"></div>
            <div class="col-xl-2">
                <select class="form-select" name="" id="">
                    <option class="py-2" value="">Mới Nhất</option>
                    <option class="py-2" value="">Giá Gảm Dần</option>
                    <option class="py-2" value="">Giá Tăng Dần</option>
                </select>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $item)
                <div class="col-xl-4">
                    <div class="card">
                        <h2 class="card-title">{{ $item->name }}</h2>
                        <img src="{{ url($item->thumnail) }}" alt="">
                        <div class="card-desc">
                            <div id="info" class="mb-2 text-center">
                                <p>Chiều Cao : <strong>{{$item->height}}</strong> cm </p>
                                <p>Chiều Rộng : <strong>{{$item->width}}</strong> cm </p>
                                <p>Chiều Dài : <strong>{{$item->long}}</strong> cm</p>
                                <p>Chất Liệu: <strong>{{$item->material}}</strong></p>
                                <p>Giá : {{number_format($item->price,0,',','.')}} đ </p>
                            </div>
                            <div class="d-flex justify-content-evenly">
                                <a href="{{ route('cart.add', ['id'=>$item->id]) }}" class="btn btn-primary">Thêm Vào Giỏ Hàng</a>
                                <a href="{{ route('show', ['id'=>$item->id]) }}" class="btn ms-3 btn-success">Xem Chi Tiết</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
