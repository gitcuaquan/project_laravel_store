<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Manh Quan Store</title>
</head>

<body>

<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-xl-2">
                <div id="logo">
                    <a href="{{ url('/') }}"><img class="img-fluid" src="{{ asset('img/logoquan.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-7">

            </div>
            <div class="col-xl-3">
                <div class="row mt-3">
                    <div class="col-xl-6"><a href="{{ url('login') }}" class="btn btn-success">Đăng Nhập</a></div>
                    <div class="col-xl-6"><a href="{{ url('register') }}" class="btn btn-info">Đăng Ký</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ================================= Header =========================== --}}

{{-- =================================content============================ --}}

<div id="contnet">
    <h1 class="text-center">Xin Chào </h1>
</div>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
