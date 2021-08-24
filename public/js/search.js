$(document).ready(function() {
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $("#search").keyup(function() {
        var key = $(this).val();
        data = { key: key, _token: CSRF_TOKEN }
        $.ajax({
            type: "post",
            url: "search",
            data: data,
            dataType: "json",
            success: function(res) {
                $("#result-search").show();
                $(".search-item").remove();
                res.result.forEach(x => {
                    let html = `<li class='search-item bg-b'><a class='text-decoration-none text-dark fw-bold ' href="edit/${x.id}"><strong>Tên</strong>: ${x.name} | <strong>Email</strong>: ${x.email} </a></li>`
                    $("#result-search").prepend(html);
                })
            },
            error: function(res) {
                console.log(res.responseText);
            }
        });
    });
});