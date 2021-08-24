@extends('layouts.client')

@section('title')
    Chi Tiết Sản Phẩm
@endsection


@section('link_css')
    <link rel="stylesheet" href="{{ asset('css/client_css/detail.css') }}">
@endsection


@section('link_js')
    {{-- <script src="{{ asset('js/client_js/home.js') }}"></script> --}}
@endsection


@section('content')
    <div style="min-height: 770px;background: rgb(231, 231, 231);" class=" pt-5">
        <div class="container mt-5 ">
            <div class="row pt-5">
                <div class="col-md-7">
                    <img src="{{ url($product->thumnail) }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-5 px-5">
                    <div id="info" style="width: 490px;" class="m-auto">
                        <h1 id="product-name" class="text-dark text-start">{{ $product->name }}</h1>
                        <h4 for="" class="fw-light">Thông Số Liên Quan</h4>
                        <div class="row ps-4">
                            <div class="col-12 mb-2 d-flex">
                                <span class="title">{{ $product->width != null ? 'Chiều Rộng ' : '' }}</span>
                                <span class="text">{{ $product->width != null ? $product->width . ' cm' : '' }}</span>
                            </div>
                            <div class="col-12 mb-2 d-flex">
                                <span class="title">{{ $product->height != null ? 'Chiều cao ' : '' }}</span>
                                <span class="text">{{ $product->height != null ? $product->height . ' cm' : '' }}</span>
                            </div>
                            <div class="col-12 mb-2 d-flex">
                                <span class="title">{{ $product->long != null ? 'Chiều dài' : '' }}</span>
                                <span class="text">{{ $product->long != null ? $product->long . ' cm' : '' }}</span>
                            </div>
                        </div>
                        <div class="row mt-3" id="material">
                            <h4 class="mb-3">Chất liệu</h4>
                            <div class="col-4"><span class="p-3  bg-dark text-light">{{ $product->material }}</span></div>
                        </div>
                        <div class="row mt-4">
                            <h4 for="" class="fw-light">Số Lượng</h4>
                            <input type="number" class="fs-5 ms-3 w-25" id="input_oder" value="1" min="1">
                        </div>
                        <div class="row mt-5">
                            <a href="{{ route('cart.detail_add', ['id' => $product->id]) }}" class="btn-cs">
                                <svg width="277" height="62">
                                    <defs>
                                        <linearGradient id="grad1">
                                            <stop offset="0%" stop-color="#FF8282" />
                                            <stop offset="100%" stop-color="#E178ED" />
                                        </linearGradient>
                                    </defs>
                                    <rect x="5" y="5" rx="25" fill="none" stroke="url(#grad1)" width="266" height="50">
                                    </rect>
                                </svg>

                                <span>Mua Ngay <i class="fas fs-3 fa-shopping-basket"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row pt-5">
            <div class="col-12">
                <h1 class="text-center">Chi Tiết Sản Phẩm</h1>
                <div id="description">
                    {{ $product->description }}
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-5">
            <h3 class="text-center">Bạn Cũng Quan Tâm</h3>
        </div>
    </div>

@endsection
