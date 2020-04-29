tinymce.init({
    selector: '#contentArea',

    plugins: [
        'advlist link image lists code help table wordcount',
        'emoticons', // emoji icons
        'imagetools'
    ],
    menubar: 'file edit view insert format table help',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image link | emoticons',

    height: 500,
    language: 'ru',

    /* image config */
    images_upload_handler: function (blobInfo, success, failure) {
        let xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', '/admin/upload/upload-image');

        xhr.onload = function() {
            let json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        /* append csrf token */
        formData.append(yii.getCsrfParam(), yii.getCsrfToken());

        xhr.send(formData);
    },

    relative_urls : false,
    convert_urls : true,
    image_caption: true, // figure tag
    extended_valid_elements: 'figure[class|name|id],figcaption[class|name|id]',
});