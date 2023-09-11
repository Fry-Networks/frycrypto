var map;
var marker;

function initializeMap(lat, lng) {
    var mapOptions = {
        center: new google.maps.LatLng(lat, lng),
        zoom: 12
    };
    map = new google.maps.Map(document.getElementById("map"), mapOptions);

    // Add click event listener to map
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
    });
}

function initializeAutocomplete() {
    var input = document.getElementById('search');
    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }
        var lat = place.geometry.location.lat();
        var lng = place.geometry.location.lng();

        if (marker) {
            marker.setMap(null);
        }

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map,
            draggable: true
        });

        map.setCenter(new google.maps.LatLng(lat, lng));
        placeMarker(new google.maps.LatLng(lat, lng));
    });
}

function postLatLng(lat, lng) {
    $.ajax({
        url: '/save-miner-coordinates',
        type: 'POST',
        data: {
            latitude: lat,
            longitude: lng
        },
        success: function(response) {
            showBanner('success', 'Successfully saved coordinates.');
        },
        error: function() {
            showBanner('danger', 'Failed to save coordinates.');
        }
    });
}
function showBanner(type, message) {
    var banner = `<div id="banner" class="alert alert-${type}">${message}</div>`;
    $('#banner-container').html(banner);

    setTimeout(function() {
        $('#banner').remove();
    }, 5000);
}
document.addEventListener("DOMContentLoaded", function() {
    initializeMap(lat, lng); // Initialize map with a default location
    placeMarker(new google.maps.LatLng(lat, lng));
    initializeAutocomplete();

    document.getElementById("submit").addEventListener("click", function() {
        if (marker) {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            postLatLng(lat, lng);
        }
    });

    document.getElementById("show-location").addEventListener("click", function() {
        showCurrentLocationAsBlueDot();
    });
});

function placeMarker(location) {
    if (marker) {
        marker.setMap(null);
    }

    marker = new google.maps.Marker({
        position: location,
        map: map,
        draggable: true
    });

    // Update the input field with the marker's location
    document.getElementById("marker_location").value = `Latitude: ${location.lat()}, Longitude: ${location.lng()}`;

    // Update the input field when the marker is dragged
    google.maps.event.addListener(marker, 'dragend', function(event) {
        document.getElementById("marker_location").value = `Latitude: ${event.latLng.lat()}, Longitude: ${event.latLng.lng()}`;
    });
}

function showCurrentLocationAsBlueDot() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            initializeMap(lat, lng);
            placeMarker(new google.maps.LatLng(lat, lng));

        }, function() {
            showBanner('danger', 'Geolocation is not supported by this browser.');
        });
    } else {
        showBanner('danger', 'Geolocation is not supported by this browser.');
    }
}
