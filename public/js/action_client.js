$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop()) {
            $("#header").addClass('header-scroll');
        } else {
            $("#header").removeClass('header-scroll');
        }
    });

    function removeAlert() {
        $("#alert").fadeOut()
        $("#alert-2").fadeOut()
    }
    setInterval(removeAlert, 2000)

    $("#product_click").click(function() {
        $("#wp-submenu").slideToggle();
        $("#wp-cart").fadeOut();

    });
    $("#header-cart").click(function(e) {
        e.preventDefault();
        $("#wp-cart").fadeIn();
        $("#wp-submenu").slideUp();
    });
    $(".outer").click(function(e) {
        e.preventDefault();
        $("#wp-cart").fadeOut();
    });

    $(".cursor").click(function(e) {
        e.preventDefault();
        const key = $(this).attr('data-id');
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        var data = { '_token': CSRF_TOKEN, 'key': key }
        $.ajax({
            type: "POST",
            url: 'http://localhost/project1/ajax/ajaxCat',
            data: data,
            dataType: "json",
            success: function(res) {

                if (res.res.length > 0) {
                    $("#wp-list-result h5").remove();
                    res.res.forEach(x => {
                        const html = `  <h5 class="py-3"><a href="" class="text-decoration-none  list_item text-dark">${x.name}</a></h5>`
                        $("#wp-list-result").append(html);
                    });
                    const html2 = `<h5 class="py-3"><a href="${key}" class="text-decoration-none  list_item text-dark">Xem Tất Cả Sản Phẩm</a></h5>`
                    $("#wp-list-result").append(html2);
                    $("#wp-list-result").slideDown();
                }
            },
            error: function(res) {
                console.log(res)
            }
        });
    });

    $(".btn-delete").click(function() {
        var rowId = $(this).attr('data-id');
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        var data = { '_token': CSRF_TOKEN, 'rowId': rowId }
        $.ajax({
            type: "POST",
            url: 'http://localhost/project1/cart/delete',
            data: data,
            dataType: "json",
            success: function(res) {
                var idRemove = res.id_remove;
                const ideR = document.getElementById(idRemove);
                const cleR = document.getElementsByClassName(idRemove);
                $(ideR).remove();
                $(cleR).remove();
                const numOder = res.num_oder;
                const total = res.total;
                $("#cart_count").text(numOder);
                if (total == 0) {
                    $("#bill").remove();
                }
                $("#product-toatal").text(`Tổng số lượng : ${ numOder}`);
                $("#overvalued").text(`Tổng tiền : ${total}`);
            },
            error: function(res) {
                console.log(res.responseText)
            }
        });
    });
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    $(".btn-oder").click(function(e) {
        e.preventDefault();
        var email, phone, name, address;

        email = $("#email").val();
        address = $("#address").val();
        phone = $("#phone").val();
        name = $("#name").val();


        if (phone == "") {
            $(".phone").text(" Vui lòng nhập vào đây");
        } else {
            if (phone.length < 9) {
                $(".phone").text("vui lòng nhập số điện thoại");

            } else {
                $(".phone").text("");
            }
        }
        if (name == "") {
            $(".name").text(" Vui lòng nhập vào đây");
        } else {
            $(".name").text("");
        }

        if (email == "") {
            $(".email").text(" Vui lòng nhập vào đây");
        } else {
            $(".email").text("");
        }
        if (address == "") {
            $(".address").text(" Vui lòng nhập vào đây");
        } else {
            $(".address").text("");
        }
        if (phone != "" && name != "" && address != "" && email != "") {

            $("#loading").show();
            var data = {
                'name': name,
                'phone': phone,
                'address': address,
                'email': email,
                '_token': CSRF_TOKEN
            }

            $.ajax({
                type: "post",
                url: "http://localhost/project1/cart/store",
                data: data,
                dataType: "json",
                success: function(res) {
                    $("#loading").hide();
                    $("#alert-title").text(`Đặt Hàng Thành Công `);
                    $("#alert-content").text(`Mã Đơn Hàng : ${res.bill_code} `);
                    $("#alert").slideDown();
                },
                error: function(res) {
                    console.log(res.responseText)
                }
            });
        }
    });

    $(".oder").change(function(e) {
        var oder = $(this).val();
        let rowId = $(this).attr('data-id')
        if ($(this).val() == "") {
            $(this).val(1)
            oder = 1;
        }

        var data = { 'oder': oder, 'rowId': rowId, '_token': CSRF_TOKEN }
        $.ajax({
            type: "post",
            url: "http://localhost/project1/cart/update",
            data: data,
            dataType: "json",
            success: function(res) {
                $(".sub_total_" + rowId).text(res.sub_total);
                $("#total").text(res.total);
                $("#num_oder").text(res.num_oder);
            },
            error: function(res) {
                console.log(res.responseText)
            }
        });
    });

});