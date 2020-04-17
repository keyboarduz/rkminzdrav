let newsGrid = document.querySelector('.news-grid');
let masonry;

if (newsGrid) {

    masonry = new Masonry( newsGrid, {
        // options
        itemSelector: '.news-grid-item',
        columnWidth: '.news-grid-sizer',
        percentPosition: true
    });

    imagesLoaded(newsGrid).on('progress', function () {
        // layout Masonry after each image loads
        masonry.layout();
    });
}