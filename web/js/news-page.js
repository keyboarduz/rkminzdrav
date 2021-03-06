let newsGrid = document.querySelector('.grid');
let masonry;

if (newsGrid) {

    masonry = new Masonry( newsGrid, {
        // options
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });

    imagesLoaded(newsGrid).on('progress', function () {
        // layout Masonry after each image loads
        masonry.layout();
    });
}