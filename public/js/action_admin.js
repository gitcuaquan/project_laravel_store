$(document).ready(function() {
    $(".icon_user").click(function() {
        $("#user_action").toggle(500);
    });

    function show(name) {
        if (!$("#" + name).hasClass("active")) {
            $("#" + name).hover(function() {
                $("#" + name + "_sub_menu").stop().show(100);
            }, function() {
                $("#" + name + "_sub_menu").stop().hide(300);
            });
        }
        $("#" + name).click(function() {
            $("#" + name + "_sub_menu").stop().toggle(300);
        })

    }


    show("product")
    show("oder")
    show("user")
    show("post")
    show("cat")
    $(".fa-angle-right").click(function() {
        $("#sidebar").toggleClass('action');
    });

});