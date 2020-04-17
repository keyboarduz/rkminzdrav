let newsGrid = document.querySelector('.news-grid');
if (newsGrid) {
    const masonry = new Masonry( newsGrid, {
        // options
        itemSelector: '.news-grid-item',
        // columnWidth: '.news-grid-sizer',
        percentPosition: true
    });
}