@extends('layouts.client')

@section('title')
    Trang Chủ
@endsection


@section('link_css')
<link rel="stylesheet" href="{{ asset('css/client_css/home.css') }}">
@endsection


@section('link_js')
    <script src="{{ asset('js/client_js/home.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row m-0 ">
            <div id="banner" class="p-0">
                <img src="{{ asset('img/manhquan.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container">
        <div id="list-product" class="row my-5">
            <div class="col-xl-3 img-hover">
                <a href="" class=" text-decoration-none">
                    <img src="{{ asset('img/baner1.jpeg') }}" alt="" class="img-fluid ">
                    <span class="label-click">
                        SOFA
                    </span>
                </a>
            </div>
            <div class="col-xl-3 img-hover">
                <a href="" class=" text-decoration-none">
                    <img src="{{ asset('img/baner2.jpeg') }}" alt="" class="img-fluid ">
                    <span class="label-click">
                        GHẾ
                    </span>
                </a>
            </div>
            <div class="col-xl-3 img-hover">
                <a href="" class=" text-decoration-none">
                    <img src="{{ asset('img/baner3.jpeg') }}" alt="" class="img-fluid ">
                    <span class="label-click">
                        BÀN
                    </span>
                </a>
            </div>
            <div class="col-xl-3 img-hover">
                <a href="" class=" text-decoration-none">
                    <img src="{{ asset('img/baner4.jpeg') }}" alt="" class="img-fluid ">
                    <span class="label-click">
                        GIƯỜNG
                    </span>
                </a>
            </div>
        </div>

        <div class="row my-5 py-5">
            <div class="col-xl-1 "></div>
            <div class="col-xl-4 ">
                <h5>Giới Thiệu Về</h5>
                <h1>ManhQuan Furniture</h1>
                <p class="fw-light fs-5">Việc ra đời của ManhQuan Furniture là cả quá trình đúc kết, tìm hiểu về đặc thù của
                    từng loại
                    không gian và các xu hướng sở thích khác nhau từ người sử dụng. Những nghiên cứu kỹ lưỡng đó được kết
                    hợp khéo léo cùng tài năng của các nhà thiết kế nổi tiếng Châu Âu, tạo nên dòng sản phẩm trang trí, đồ
                    nội thất đẹp có độ ứng dụng cao với nhiều loại hình không gian khác nhau. Gần gũi và ấm cúng cho nhà ở;
                    cởi mở và thời trang cho khách sạn; chuyên nghiệp, năng động khi sử dụng cho văn phòng... phong thái từ
                    các thiết kế của ManhQuan Furniture luôn tạo được sức hút bởi tính đa chiều trong cảm xúc mà chúng mang
                    lại cho
                    không gian.</p>
                <a href="" class="text-decoration-none text-dark"> Tìm hiểu thêm <i
                        class="fas ps-3 fa-long-arrow-alt-right"></i></a>
            </div>
            <div class="col-1"></div>
            <div class="col-xl-6">
                <img src="{{ asset('img/baner5.jpeg') }}" alt="" class="img-fluid">
            </div>
        </div>

        <div class="row my-5 py-5">
            <div class="col-xl-1 "></div>
            <div class="col-xl-4 ">
                <h5>Không Gian Sống Tiêu Chuẩn</h5>
                <h3>Standard river space</h3>
                <p class="fw-light fs-5">Không Gian Sống Tiêu Chuẩn ghi dấu trong mọi lĩnh vực từ nghệ thuật, kiến trúc,
                    khoa học
                    công nghệ, bề dày lịch sử cho đến phúc lợi xã hội. Những thành tựu đó đã tạo nên nền tảng vững chắc để
                    đảm bảo cho nhịp sống thanh bình, biết trân trọng các giá trị chân thực và luôn sáng tạo để mang đến
                    những điều tốt đẹp cho cuộc sống. Đặc biệt hơn nữa, yếu tố tinh thần này luôn thể hiện rõ nét trong từng
                    góc sống, từng tổ ấm của người dân nơi đây.Đất nước Đan Mạch ghi dấu trong mọi lĩnh vực từ nghệ thuật,
                    kiến trúc, khoa học công nghệ, bề dày lịch sử cho đến phúc lợi xã hội. Những thành tựu đó đã tạo nên nền
                    tảng vững chắc để đảm bảo cho nhịp sống thanh bình, biết trân trọng các giá trị chân thực và luôn sáng
                    tạo để mang đến những điều tốt đẹp cho cuộc sống. Đặc biệt hơn nữa, yếu tố tinh thần này luôn thể hiện
                    rõ nét trong từng góc sống, từng tổ ấm của người dân nơi đây.</p>
                <a href="" class="text-decoration-none text-dark"> Tìm hiểu thêm <i
                        class="fas ps-3 fa-long-arrow-alt-right"></i></a>
            </div>
            <div class="col-1"></div>
            <div class="col-xl-6 pt-5">
                <img src="{{ asset('img/baner6.jpeg') }}" alt="" class="img-fluid pt-5">
            </div>
        </div>

        <div class="row my-5 py-5">
            <div class="col-xl-12 text-center">
                <div id="email">
                    <i class="fas fs-1 fa-envelope-square"></i>
                    <h1>Đăng ký và nhận ngay những ưu đãi hấp dẫn tại <br> ManhQuan Furniture </h1>
                </div>
            </div>
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <div class="input-group email-home mb-3">
                    <input type="text" class="form-control" placeholder="Nhập Email Của Bạn Vào Đây">
                    <span class="input-group-text btn btn-secondary  " id="basic-addon2">Đăng Ký</span>
                </div>
            </div>
        </div>
    </div>
@endsection
