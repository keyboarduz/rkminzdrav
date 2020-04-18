let covidNewsGrid = document.querySelector('.grid');
let masonry;

if (covidNewsGrid) {

    masonry = new Masonry( covidNewsGrid, {
        // options
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });

    imagesLoaded(covidNewsGrid).on('progress', function () {
        // layout Masonry after each image loads
        masonry.layout();
    });
}