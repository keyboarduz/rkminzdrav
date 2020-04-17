let newsGrid = document.querySelector('.news-grid');
let masonry;

if (newsGrid) {
    imagesLoaded(newsGrid, function () {
        // init Isotope after all images have loaded
        masonry = new Masonry( newsGrid, {
            // options
            itemSelector: '.news-grid-item',
            columnWidth: '.news-grid-sizer',
            percentPosition: true
        });
    });
}