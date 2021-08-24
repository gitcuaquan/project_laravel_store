<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/style_admin.css') }}">
    @yield('link_css')
    <title>Trang Quản Trị</title>
</head>

<body>

    <div id="header" class="bg-light position-fixed  shadow w-100">
        <div class="container-fluid  ">
            <div class="row ">
                <div class="col-xl-1 col-md-3 col-sm-3 col-6">
                    <div id="logo">
                        <a href="{{ url('/') }}"><img class="img-fluid" src="{{ asset('img/logoquan.png') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-xl-10"></div>
                        <div class="col-xl-2"></div>
                    </div>
                </div>
                <div class="col-xl-2 ">
                    {{-- ============================show name ========================= --}}
                    <p class="mt-3 fs-6">Xin Chào
                        <strong>{{ Auth::user()->name }}</strong>
                        <i class=" text-warning  ms-3  fs-3 fas fa-bell"></i>
                        <span class="icon_user">
                            <i class=" fas text-info ms-3 fs-3 fa-user"></i>
                            <div id="user_action" class="py-2">
                                <a href="{{ route('user.edit', ['id'=>Auth::id()]) }}" class="text-decoration-none px-4">Thông Tin </a><br>
                                <a href="{{ url('logout') }}" class="text-decoration-none px-4">Đăng Xuất </a>
                            </div>
                        </span>
                    </p>
                    {{-- ============================================================= --}}
                </div>
            </div>
        </div>
    </div>
    @php
        $active = session('module_active');
    @endphp
    <div id="sidebar">
        <div id="sidebar_action">
            <i class="fas icon_action fa-angle-right"></i>
        </div>
        <div id="dashboard" class="{{ $active == 'dashboard' ? 'active' : '' }} ">
            <a class="text-dark text-decoration-none" href="{{ route('dashboard') }}">
                <h4 class=" hover at_cl p-1 w-75">Dashboard <i class="fas fa-chart-line ms-2"></i></h4>
            </a>
        </div>
        <div id="product" class="mt-3 {{ $active == 'product' ? 'active' : '' }}">
            <h4 class=" hover at_cl p-1 w-75 ">Sản Phẩm<i class="fas ms-3 fa-boxes"></i></h4>
            <ul id="product_sub_menu" class="sub_menu ">
                <li class="sub_item"><a href="{{ route('product.add') }}">
                        <h5>Thêm Sản Phẩm</h5>
                    </a></li>
                <li class="sub_item"><a href="{{ route('product.show') }}">
                        <h5>Danh Sách Sản Phẩm</h5>
                    </a></li>
            </ul>
        </div>
        <div id="oder" class="mt-3 {{ $active == 'oder' ? 'active' : '' }} ">
            <h4 class=" hover p-1 at_cl w-75 ">Đơn Hàng<i class="fas ms-4 fa-file-invoice"></i></h4>
            <ul id="oder_sub_menu" class="sub_menu">
                <li class="sub_item"><a href="{{ route('oder.show') }}">
                        <h5>Danh Sách Đơn Hàng</h5>
                    </a></li>
                <li class="sub_item"><a href="">
                        <h5>Doanh Thu</h5>
                    </a></li>
            </ul>
        </div>
        <div id="user" class="mt-3  {{ $active == 'user' ? 'active' : '' }}">
            <h4 class=" hover p-1 at_cl w-75 ">Thành Viên<i class="fas ms-3 fa-users-cog"></i></h4>
            <ul id="user_sub_menu" class="sub_menu">
                <li class="sub_item"><a href="{{ route('user.show') }}">
                        <h5>Danh Sách Thành Viên</h5>
                    </a></li>
                <li class="sub_item"><a href="{{ route('user.add') }}">
                        <h5>Thêm Thành Viên</h5>
                    </a></li>
            </ul>
        </div>
        <div id="post" class="mt-3 {{ $active == 'post' ? 'active' : '' }} ">
            <h4 class=" hover p-1 at_cl w-75 ">Bài Viết<i class="fas ms-5 fa-pencil-ruler"></i></h4>
            <ul id="post_sub_menu" class="sub_menu">
                <li class="sub_item"><a href="{{ route('post.show') }}">
                        <h5>Danh Sách Bài Viết</h5>
                    </a></li>
                <li class="sub_item"><a href="{{ route('post.add')}}">
                        <h5>Thêm Bài Viết</h5>
                    </a></li>
            </ul>
        </div>
        <div id="cat" class="mt-3 {{ $active == 'cat' ? 'active' : '' }} ">
            <h4 class=" hover p-1 at_cl w-75 ">Danh Mục<i class="fas ms-4 fa-clipboard-list"></i></h4>
            <ul id="cat_sub_menu" class="sub_menu">
                <li class="sub_item"><a href="{{ route('cat.add_parent') }}">
                        <h5>Thêm Danh Mục Cha </h5>
                    </a></li>
                <li class="sub_item"><a href="{{ route('cat.add_children') }}">
                        <h5>Thêm Danh Mục Con</h5>
                    </a></li>
            </ul>
        </div>
    </div>
    <div id="wp-content" style="min-height: 875px;">
        <div class="container pt-3">
            @yield('content')
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/action_admin.js') }}"></script>
    @yield('link_js')
</body>

</html>
