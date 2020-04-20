$('.dropdown-toggle').click(function(e) {
    if ($(document).width() > 768) {
        e.preventDefault();

        var url = $(this).attr('href');


        if (url !== '#') {

            window.location.href = url;
        }

    }
});
//Auto Materialize components init
M.AutoInit();

// navbardagi dropdownlar
var ministryElem = document.querySelectorAll('.dropdown-trigger');
var navDropdownOptions = {
    hover: true,
    coverTrigger: false,
    constrainWidth: false,
    autoTrigger: false
};

ministryElem.forEach(function (value, index) {
   M.Dropdown.init(value, navDropdownOptions);
});
// var instance = M.Dropdown.init(ministryElem, navDropdownOptions);


//sidenav init
var sideNavElem = document.querySelector('.sidenav');
var sideNavInstance = M.Sidenav.init(sideNavElem, {});

//sidenav collapsible init
// var sideNavCollapsibleElem = document.querySelector('.collapsible');
// var sideNavCollapsibleInstance = M.Collapsible.init(sideNavCollapsibleElem);

/*
document.addEventListener('DOMContentLoaded', function () {
    const navbarContainer = document.getElementById('navbarContainer');
    const topHeader = document.getElementById('topHeader');
    if (navbarContainer && topHeader) {
        window.addEventListener('scroll', function () {
            console.log('scroll');
            if (navbarContainer.getBoundingClientRect().top < -100) {
                topHeader.classList.add('hide');
                navbarContainer.classList.add('navbar-fixed');

            }
        });
    }
});*/
