var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

$(document).ready(function() {
    $("#file").change(function() {
        var files = $('#file')[0].files;
        if (files.length > 0) {
            var fd = new FormData();
            fd.append('file', files[0]);
            fd.append('_token', CSRF_TOKEN);
            $('#responseMsg').hide();
            $.ajax({
                url: "ajax",
                method: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    // Ẩn lỗi container.
                    $('#err_file').removeClass('d-block');
                    $('#err_file').addClass('d-none');
                    if (response.success == 1) { // Tải lên thành công
                        // tin nhắn phản hồi
                        $('#responseMsg').removeClass("alert-danger");
                        $('#responseMsg').addClass("alert-success");
                        $('#responseMsg').html(response.message);
                        $('#responseMsg').show();
                        $("#path_img").val(response.pathsave);
                        // Xem trước tệp
                        if (response.extension == 'jpg' || response.extension == 'jpeg' || response.extension == 'png' || response.extension == 'svg' || response.extension == 'gif') {
                            $('#result img').attr('src', response.filepath);
                            $('#result img').show(200);
                        } else {
                            $('#result a').attr('href', response.filepath).show();
                            $('#filepreview a').show();
                        }
                    } else if (response.success == 2) { // tập tin không được tải lên
                        // Response message
                        $('#responseMsg').removeClass("alert-success");
                        $('#responseMsg').addClass("alert-danger");
                        $('#responseMsg').html(response.message);
                        $('#responseMsg').show();
                    } else if (response.success == 0) {
                        $('#responseMsg').removeClass("alert-success");
                        $('#responseMsg').addClass("alert-danger");
                        $('#responseMsg').html(response.error);
                        $('#responseMsg').show();
                        $('#result img').hide(200);
                    } else {
                        // Lỗi hiển thị
                        $('#err_file').text(response.error);
                        $('#err_file').removeClass('d-none');
                        $('#err_file').addClass('d-block');
                    }
                },
                error: function(response) {
                    console.log("error : " + JSON.stringify(response));
                }
            });
        }
    });
});