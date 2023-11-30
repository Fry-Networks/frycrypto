points = points
    .map(point => [
        point[0] !== null ? parseFloat(point[0]) : null,
        point[1] !== null ? parseFloat(point[1]) : null
    ])
    .filter(point => function () {
        if (point[0] === null || point[1] === null) {
            return false;
        }
        if (isNaN(point[0]) || isNaN(point[1])) {
            return false;
        }
        if (point[0] < -90 || point[0] > 90) {
            return false;
        }
        return !(point[1] < -180 || point[1] > 180);
    }());
console.log(points);
const {GoogleMapsOverlay} = deck;
const mapStyle = [
    {elementType: 'geometry', stylers: [{color: '#f5f5f5'}]},
    {elementType: 'labels.icon', stylers: [{visibility: 'off'}]},
    {elementType: 'labels.text.fill', stylers: [{color: '#616161'}]},
    {elementType: 'labels.text.stroke', stylers: [{color: '#f5f5f5'}]},
    {
        featureType: 'administrative.land_parcel',
        elementType: 'labels.text.fill',
        stylers: [{color: '#bdbdbd'}]
    },
    {
        featureType: 'poi',
        elementType: 'geometry',
        stylers: [{color: '#eeeeee'}]
    },
    {
        featureType: 'poi',
        elementType: 'labels.text.fill',
        stylers: [{color: '#757575'}]
    },
    {
        featureType: 'poi.park',
        elementType: 'geometry',
        stylers: [{color: '#e5e5e5'}]
    },
    {
        featureType: 'poi.park',
        elementType: 'labels.text.fill',
        stylers: [{color: '#9e9e9e'}]
    },
    {
        featureType: 'road',
        elementType: 'geometry',
        stylers: [{color: '#ffffff'}]
    },
    {
        featureType: 'road.arterial',
        elementType: 'labels.text.fill',
        stylers: [{color: '#757575'}]
    },
    {
        featureType: 'road.highway',
        elementType: 'geometry',
        stylers: [{color: '#dadada'}]
    },
    {
        featureType: 'road.highway',
        elementType: 'labels.text.fill',
        stylers: [{color: '#616161'}]
    },
    {
        featureType: 'road.local',
        elementType: 'labels.text.fill',
        stylers: [{color: '#9e9e9e'}]
    },
    {
        featureType: 'transit.line',
        elementType: 'geometry',
        stylers: [{color: '#e5e5e5'}]
    },
    {
        featureType: 'transit.station',
        elementType: 'geometry',
        stylers: [{color: '#eeeeee'}]
    },
    {
        featureType: 'water',
        elementType: 'geometry',
        stylers: [{color: '#c9c9c9'}]
    },
    {
        featureType: 'water',
        elementType: 'labels.text.fill',
        stylers: [{color: '#9e9e9e'}]
    }
];


const explorer_map = new google.maps.Map(document.getElementById('explorer-map'), {
    center: (points && points.length > 0) ? {lat: points[0][0], lng: points[0][1]} : {lat: 51.5074, lng: -0.1278},
    zoom: 7,
    minZoom: 3,
    maxZoom: 13,
    styles: mapStyle,
    disableDefaultUI: true,
    zoomControl: true,
    zoomControlOptions: {
        position: google.maps.ControlPosition.RIGHT_BOTTOM
    }
});


// Create a GoogleMapsOverlay instance with deck.gl layers
const overlay = new GoogleMapsOverlay({
    layers: [
        new deck.HexagonLayer({
            id: 'hexagon-layer',
            data: points,
            getPosition: d => [d[1], d[0]],
            colorRange: [
                [228, 0, 0, 140],
            ],
            pickable: true,
            onClick: (info, event) => {
                hexagonClicked(info.object);
            },
        }),
        new deck.HeatmapLayer({
            id: 'heatmap-layer',
            data: points,
            getPosition: d => [d[1], d[0]],
        }),
    ],
});

overlay.setMap(explorer_map);


// Create the search box and link it to the UI element.
const input = document.getElementById('map-search');
const searchBox = new google.maps.places.SearchBox(input);

// Bias the SearchBox results towards current map's viewport.
explorer_map.addListener('bounds_changed', function () {
    searchBox.setBounds(explorer_map.getBounds());
});

searchBox.addListener('places_changed', function () {
    const places = searchBox.getPlaces();

    if (places.length == 0) {
        return;
    }

    // For each place, get the icon, name and location.
    const bounds = new google.maps.LatLngBounds();
    places.forEach(function (place) {
        if (!place.geometry) {
            console.log("Returned place contains no geometry");
            return;
        }

        if (place.geometry.viewport) {
            // Only geocodes have viewport.
            bounds.union(place.geometry.viewport);
        } else {
            bounds.extend(place.geometry.location);
        }
    });
    explorer_map.fitBounds(bounds);
});

// on click of the map, get the lat and lng

function hexagonClicked(object) {
    $.ajax({
        url: dataUrl,
        type: 'GET',
        dataType: 'json',
        data: {
            locations: object.points,
            index: object.index
        },
        success: function(data) {
            populateAndShowModal(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data: ' + textStatus, errorThrown);
        }
    });
}

function populateAndShowModal(data) {
    $('#hexagon_content').html(data);
    $('#hexagon_modal').modal('show');
}
