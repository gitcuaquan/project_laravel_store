
<div id="wp-mail"
    style="margin: auto;color: rgb(42, 49, 42);  padding: 10%;background-image: linear-gradient(to left bottom, #d16ba5, #c777b9, #ba83ca, #aa8fd8, #9a9ae1, #8aa7ec, #79b3f4, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);">
    <div style="margin: auto; " id="header">
        <div id="logo">
            <h1><img style="width: 200px;font-size: 80px" src="{{ asset('img/logoquan.png') }}" alt=""></h1>
        </div>
        <h3>Xin Chào <strong>{{ $name }}</strong>  </h3>
    </div>
    <div id="content">
        <h1 style="text-align: center;">Thông Báo Đặt hàng thành Công</h1>
        <h4 style="text-align: center;"> ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤ ❤</h4>
        <p style="font-size: 25px" class="des-short">
            Rất cảm ơn bạn đã thăm quan và mua hàng của chúng tôi ! <br> Chúng tôi cũng rất vui khi thống báo rằng đơn
            hàng của bạn đã được chúng tôi thực hiện và sẽ gao cho bạn sớm nhất có thể. <br> Dưới đây là những sản phẩm
            bạn đã đặt:
        </p>

        <table>
            @foreach (Cart::content() as $item)
                <tr>
                    <td style="padding: 5px 10px;"><h3>{{ $item->name }}</h3></td>
                    <td style="padding: 5px 10px;"> <h3> Thành Tiền :{{ number_format($item->total, 0, ',', '.') }}</h3></td>
                </tr>
            @endforeach

        </table>
    </div>
    <div id="footer">
        <h4 style="font-size: 25px" >Đơn hàng sẽ được giao đến: {{ $address }} trong thời gian sớm nhất  </h4>

        <h1>Thân Ái ! ! ! ❤ ❤ ❤</h1>
    </div>
</div>
