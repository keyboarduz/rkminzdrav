tinymce.init({
    selector: '#contentArea',

    plugins: [
        'advlist link image lists code help table wordcount',
        'emoticons' // emoji icons
    ],
    menubar: 'file edit view insert format table help',
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image link | emoticons',

    height: 500,
    language: 'ru',

    /* image config */
    images_upload_url: '/admin/news/upload-image',
    relative_urls : false,
    convert_urls : true,
});