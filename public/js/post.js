var editor_config = {
    path_absolute: "http://localhost/project1/",
    selector: 'textarea#tiny',
    relative_urls: false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback: function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
            url: cmsURL,
            title: 'Filemanager',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no",
            onMessage: (api, message) => {
                callback(message.content);
            }
        });
    }
};

tinymce.init(editor_config);

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