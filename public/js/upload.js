$(document).ready(function() {
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
        $('.img_old').remove();
        ShowMultipleImagePreview(this, 'div.show-multiple-image-preview');

    });
    $('#file').on('change', function() {
        $('#thumb_old').remove();
        ShowMultipleImagePreview(this, 'div#img_show');
    });
});