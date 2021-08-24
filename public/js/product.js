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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        // Xem trước nhiều hình ảnh với JavaScript
        var ShowMultipleImagePreview = function(input, imgPreviewPlaceholder) {
            if (input.files) {
                var filesAmount = input.files.length;
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).css('width', '300px').appendTo(imgPreviewPlaceholder);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#images').on('change', function() {
            ShowMultipleImagePreview(this, 'div.show-multiple-image-preview');
        });
    });
    $('#multiple-image-preview-ajax').submit(function() {
        var formData = new FormData(this);
        let TotalImages = $('#images')[0].files.length; //Total Images
        let images = $('#images')[0];
        for (let i = 0; i < TotalImages; i++) {
            formData.append('images' + i, images.files[i]);
        }
        formData.append('TotalImages', TotalImages);
        $.ajax({
            type: 'POST',
            url: "ajax/muti",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                if (data.status == 'success') {
                    $("#mess_muti").addClass("alert-success");
                    $("#mess_muti").text("Thêm ảnh thành công");

                    var num = data.img.length;
                    for (var i = 0; i < num; i++) {
                        var path = data.img[i].path_save
                        $("#link_images").append("<input type=\"hidden\" name=\"path_img[]\" value=" + path + " >");
                    }
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $("#category").change(function(e) {
        e.preventDefault();
        var key = $("#category").val();
        var data = { '_token': CSRF_TOKEN, 'key': key }
        $.ajax({
            type: "POST",
            url: 'http://localhost/project1/ajax/ajaxCat',
            data: data,
            dataType: "json",
            success: function(res) {
                if (res.res.length > 0) {
                    $(".op_cat").remove();
                    res.res.forEach(x => {
                        var html = `<option  class="op_cat" value="${x.id}">${x.name}</option>`
                        $("#sub_cat").append(html);
                    });
                }
            },
            error: function(res) {
                console.log(res)
            }
        });
    });
});