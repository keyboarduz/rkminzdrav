document.addEventListener('DOMContentLoaded', function () {
   var osmContainer = document.getElementById('osm-map');
   osmContainer.style = 'height:300px;';

   var map = L.map(osmContainer, {
       center: [51.505, -0.09],
       zoom: 13
   });

    // Add OSM tile leayer to the Leaflet map.
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

// Target GPS coordinates.
    var target = L.latLng('42.475997', '59.613308');

// Set map center to target with zoom 14.
    map.setView(target, 15);

// Place a marker on the same location.
    L.marker(target).addTo(map);


});