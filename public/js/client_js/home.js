$(document).ready(function() {

    $(".img-hover").hover(function() {
        $(this).children('a').children('.label-click').stop().slideToggle(200);
    }, function() {
        $(this).children('a').children('.label-click').stop().slideToggle(200);

    });

});