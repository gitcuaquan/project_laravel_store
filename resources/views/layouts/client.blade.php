<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style_client.css') }}">
    <link rel="stylesheet"
        href="{{ asset('lib\fontawesome-free-5.15.4-web\fontawesome-free-5.15.4-web\css\all.min.css') }}">
    @yield('link_css')
</head>

<body>
    <div id="loading">
        <div id="preloader" class="m-auto">
            <div id="loader"></div>
        </div>
        <h1 class="text-center load-title text-primary"> Đang Khởi Tạo Đơn Hàng Vui Lòng Đợi Trong Giây Lát</h1>
    </div>
    @if (session('status') == 'success')
        <div id="alert-2">
            <div id="alert-icon-2">
                <i class="fas fa-check"></i>
            </div>
            <div id="alert-info-2">
                <h3 id="alert-title-2" class="text-center">Thông Báo</h3>
                <p id="alert-content-2" class="text-center">Thêm Sản Phẩm Vào Giỏ Hàng Thành Công</p>
            </div>
        </div>
        @php
            session()->forget('status');
        @endphp
    @endif
    <div id="alert">
        <div id="alert-icon">
            <i class="fas fa-check"></i>
        </div>
        <div id="alert-info">
            <h3 id="alert-title" class="text-center"></h3>
            <p id="alert-content" class="text-center"></p>
        </div>
    </div>

    <div id="wp-contact">
        <div id="mess">
            <a href=""><i class="fab mess-icon fa-facebook-messenger"></i></a>
        </div>
    </div>
    <div id="wp-submenu">
        <div class="container">
            <div class="row mt-5 ">
                <div class="col-xl-2">
                    @foreach ($cat as $i)
                        <h4 data-id="{{ $i->id }}" class="fw-light cursor text-center item_hover py-3">
                            {{ $i->name }}</h4>
                    @endforeach
                </div>
                <div class="col-xl-3">
                    <div id="wp-list-result">

                    </div>
                </div>
                <div class="col-xl-7">
                    <a href="{{ url('product', ['id' => 0]) }}" class="text-decoration-none">
                        <img src="{{ asset('img/anh21.jpg') }}" alt="" class="img-fluid">
                        <span id="label-show-all">Xem Toàn Bộ Sản Phẩm</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="wp-cart">
        <div id="main-cart" class="rounded h-75 m-5 bg-light">
            <div class="row ">
                <div class="col-xl-11 text-center">
                    <h1 class="text-dark border-bottom mt-2"> GIỎ HÀNG CỦA BẠN</h1>
                </div>
                <div class="col-xl-1">
                    <div class="outer">
                        <div class="inner">
                            <label>Back</label>
                        </div>
                    </div>
                </div>
            </div>
            @if (Cart::content()->count() == 0)
                <div style="padding: 50px" class="row">
                    <h1 class="text-center m-auto text-warning"> Qúy Khách Chưa Có Sản Phẩm Nào Trong Giỏ Hàng Hãy Mua
                        Thêm</h1>
                    <h2 class="text-center m-auto"> Chúc Qúy Khách Có thêm Lựa Chọn Ưng Ý</h2>
                    <h2 class="text-center m-auto"> <img style="width:50%" src="{{ asset('img/cartempty.png') }}"
                            alt=""></h2>
                </div>
            @endif
            <div class="row">
                <div id="list_oder" id="style-1" style="max-height: 600px;min-height: 0px"
                    class="col-xl-6 overflow-auto">
                    <?php foreach(Cart::content() as $row) :?>
                    <div class="row ms-5  mt-3" id="{{ $row->rowId }}">
                        <div class="col-xl-1"></div>
                        <div class="col-3">
                            <img class="img-thumbnail item_img img-fluid" src="{{ url($row->options->thumb) }}"
                                alt="">
                        </div>
                        <div class="col-4">
                            <h4><?php echo $row->name; ?></h4>
                            <h6>Đơn Giá : <?php echo number_format($row->price, 0, ',', '.'); ?> đ</h6>
                            <h6 class="border-bottom  pb-2">Số loại : <input data-id="{{ $row->rowId }}"
                                    class="ip-c oder" type="number" min="1" value="<?php echo $row->qty; ?>" name="" id="">
                            </h6>
                            <h6>Thành Tiền: <span class="sub_total_{{ $row->rowId }}"><?php echo number_format($row->total, 0, ',', '.'); ?></span> đ
                            </h6>
                        </div>
                        <div class="col-2">
                            <div class="frame">
                                <button style="max-width:143px" class="btn pb-1 btn-outline-danger btn-delete" data-id="{{ $row->rowId }}"> <i
                                        class="fas fs-1 fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
                @if (Cart::content()->count() > 0)
                    <div id="bill" style="max-height: 585px" class="col-xl-5 col-5 border">
                        <h2 class="text-center bill-title border mb-3">Hóa Đơn</h2>
                        <div id="info-customer" class=" border-bottom">
                            <table>
                                <tr>
                                    <td>
                                        <h5>Họ Và Tên </h5>
                                    </td>
                                    <td>
                                        <h5>
                                            <input style="width:270px" type="text" id="name"
                                                value="{{ Auth::user() != null ? Auth::user()->name : '' }}"
                                                placeholder="nhập tên của bạn">
                                        </h5>

                                    </td>
                                    <td><small class="text-danger name"></small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Email </h5>
                                    </td>
                                    <td>
                                        <h5><input name="email" style="width:270px" type="email" id="email"
                                                value="{{ Auth::user() != null ? Auth::user()->email : '' }}"
                                                placeholder="nhập email của bạn"> </h5>
                                    </td>
                                    <td><small class="text-danger email"></small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Số Điện Thoại</h5>
                                    </td>
                                    <td>
                                        <h5>
                                            <input placeholder="nhập SĐT của bạn" style="width:270px" type="number"
                                                id="phone"
                                                value="{{ Auth::user() != null ? Auth::user()->phone_number : '' }}">
                                        </h5>
                                    </td>
                                    <td><small class="text-danger phone"></small></td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>Địa Chỉ Nhận</h5>
                                    </td>
                                    <td>
                                        <h5>
                                            <input placeholder="nhập địa chỉ của bạn" style="width:270px" type="text"
                                                id="address" name="phone"
                                                value="{{ Auth::user() != null ? Auth::user()->address : '' }}">
                                        </h5>
                                    </td>
                                    <td> <small class="text-danger address"></small></td>
                                </tr>
                            </table>
                        </div>
                        <div id="info-bill" style="max-height: 240px;min-height: 0px; overflow-y: auto">
                            <table class="">
                                <tr>
                                    <td> Sản Phẩm:</td>
                                </tr>
                                @foreach (Cart::content() as $item)
                                    <tr class="{{ $item->rowId }}">
                                        <td></td>
                                        <td>{{ $item->name }}</td>
                                        <td class="ps-5 ">Giá : <span
                                                class="sub_total_{{ $item->rowId }}">{{ number_format($item->total, 0, ',', '.') }}
                                            </span> đ</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div id="info-total" class="border-top">
                            <div id="product-toatal">
                                Tổng số lượng : <span id="num_oder"> {{ Cart::content()->count() }}</span>
                            </div>
                            <div id="overvalued">
                                Tổng tiền : <span id="total">{{ Cart::total(0, ',', '.') }}</span> đ
                            </div>
                        </div>
                        <a href="" class="btn btn-oder btn-success mt-5">Đặt Hàng</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div id="header">
        <div class="container ">
            <div class="row ">
                <div class="col-xl-2">
                    <div id="logo">
                        <a href="{{ url('/') }}"><img style="width:150px" src="{{ asset('img/logoquan.png') }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-8">
                            <ul id="header-menu" class="d-flex m-0 mt-3">
                                <li class="menu-item">
                                    <a href=" {{ url('/') }}">TRANG CHỦ</a>
                                </li>
                                <li class="menu-item" id="product_click">
                                    SẢN PHẨM
                                </li>
                                <li class="menu-item">
                                    <a href="">TIN TỨC</a>
                                </li>
                                <li class="menu-item">
                                    <a href="">DỰ ÁN</a>
                                </li>
                                <li class="menu-item">
                                    <a href="">LIÊN HỆ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-xl-3 d-flex mt-3 justify-content-between">
                            <div id="header-search">
                                <i class="fas fa-search"></i>
                            </div>
                            <div id="header-user">
                                <a href="{{ url('login') }}" class="text-dark"> <i class="fas fa-user"></i></a>
                            </div>
                            <div id="header-cart">
                                <i class="fas fa-shopping-cart"></i>
                                <span id="cart_count">{{ Cart::content()->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="content">
        @yield('content')
    </div>
    <div id="footer">
        <div class="container">
            <div class="row pb-4">
                <div class="col-4"></div>
                <div class="col-4 d-flex justify-content-between ">
                    <a href="" class="fw-blod fs-5 text-decoration-none text-dark">Giới Thiệu</a>
                    <a href="" class="fw-blod fs-5 text-decoration-none text-dark">Cửa Hàng</a>
                    <a href="" class="fw-blod fs-5 text-decoration-none text-dark">Dịch Vụ Khách Hàng</a>
                </div>
            </div>
            <div class="row pb-4 ">
                <div class="col-3"></div>
                <div class="col-6 d-flex justify-content-between ">
                    <a href="" class=" text-decoration-none text-dark fw-light">Chính Sách Bảo Hành</a>
                    <a href="" class=" text-decoration-none text-dark fw-light">Bảo Hành Điện Tử</a>
                    <a href="" class=" text-decoration-none text-dark fw-light">Hỏi Đáp</a>
                    <a href="" class=" text-decoration-none text-dark fw-light">Tuyển Dụng</a>
                </div>
            </div>
            <div class="row pb-4">
                <div class="col-5"></div>
                <div class="col-2 d-flex justify-content-between ">
                    <div id="facebook" class="border-ct">
                        <a href="" class=" text-decoration-none text-dark fw-light"> <i
                                class="fab fs-3 fa-facebook-f"></i></a>
                    </div>
                    <div id="youtobe" class="border-ct">
                        <a href="" class=" text-decoration-none text-dark fw-light"> <i
                                class="fab fs-3 fa-youtube"></i></a>

                    </div>
                    <div id="insta" class="border-ct">
                        <a href="" class=" text-decoration-none text-dark fw-light"> <i
                                class="fab fs-3 fa-instagram"></i></a>

                    </div>
                </div>
            </div>
            <div class="row pb-5">
                <div class="col-5"></div>
                <div class="col-2">
                    <span class=" fw-light"> <i class="far me-4  fa-copyright"></i>ManhQuan 2021</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/action_client.js') }}"></script>
    @yield('link_js')
</body>

</html>
