tinymce.init({
    selector: '#contentArea',

    plugins: 'advlist link image lists code help table wordcount',
    menubar: 'file edit view insert format table help',
    toolbar: 'image | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',

    height: 500,
    language: 'ru',

    /* image config */
    images_upload_url: '/admin/news/upload-image',
    relative_urls : false,
    convert_urls : true,
});