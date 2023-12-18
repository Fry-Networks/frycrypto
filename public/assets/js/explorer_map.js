async function initExplorerMap() {
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


    let defaultZoom = 8;
    let defaultCenter = (points && points.length > 0) ? {lat: points[0][0], lng: points[0][1]} : {lat: 51.5074, lng: -0.1278};

    // Check if saved zoom level and center exist in localStorage
    let savedZoom = parseInt(localStorage.getItem('mapZoomLevel')) || defaultZoom;
    let savedCenterLat = parseFloat(localStorage.getItem('mapCenterLat')) || defaultCenter.lat;
    let savedCenterLng = parseFloat(localStorage.getItem('mapCenterLng')) || defaultCenter.lng;
    let savedCenter = { lat: savedCenterLat, lng: savedCenterLng };


    const mapStyle = [
        {elementType: 'geometry', stylers: [{color: '#f5f5f5'}]},
        {elementType: 'labels.icon', stylers: [{visibility: 'off'}]},
        {elementType: 'labels.text.fill', stylers: [{color: '#616161'}]},
        {elementType: 'labels.text.stroke', stylers: [{color: '#f5f5f5'}]},
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
            featureType: 'road',
            elementType: 'geometry',
            stylers: [{color: '#ffffff'}]
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

    const {GoogleMapsOverlay} = deck;
    const { Map } = await google.maps.importLibrary("maps");


    const explorer_map = new Map(document.getElementById('explorer-map'), {
        zoom: savedZoom,
        center: savedCenter,
        minZoom: 3,
        maxZoom: 15,
        styles: mapStyle,
        disableDefaultUI: true,
        zoomControl: true,
        clickableIcons: false,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        }
    });

    const tooltip = document.getElementById('tooltip');

    const layerVisibility = {hexagon: savedZoom > 10, heatmap: savedZoom <= 10}

    const overlay = new GoogleMapsOverlay({layers: []});

    function render() {
        const hexagonLayer = new deck.HexagonLayer(
            {
                id: 'hexagon-layer',
                data: points,
                getPosition: d => [d[1], d[0]],
                colorRange: [
                    [228, 0, 0, 140],
                ],
                visible: layerVisibility.hexagon,
                extruded: false,
                pickable: true,
                radius: 1200,
                onClick: (info, event) => {
                    hexagonClicked(info.object);
                },
                onHover: info => {
                    if (info.object) {
                        tooltip.innerHTML = `Hex # ${info.object.index + 1}  <br>Miners Count: ${info.object.points.length}`;
                        tooltip.style.display = 'block';
                        tooltip.style.left = `${info.x}px`;
                        tooltip.style.top = `${info.y}px`;
                    } else {
                        tooltip.style.display = 'none';
                    }
                }

            }
        );
        const heatmapLayer = new deck.HeatmapLayer({
            id: 'heatmap-layer',
            data: points,
            visible: layerVisibility.heatmap,
            getPosition: d => [d[1], d[0]],
        });
        overlay.setProps({
            layers: [
                heatmapLayer,
                hexagonLayer
            ]
        });

    }

    render();
    let currentLayer = null;
    explorer_map.addListener('zoom_changed', () => {
        localStorage.setItem('mapZoomLevel', explorer_map.getZoom());
        const zoomLevel = explorer_map.getZoom();
        if(zoomLevel <= 10 && currentLayer !== 'heatmap') {
            currentLayer = 'heatmap';
            layerVisibility['heatmap'] = true;
            layerVisibility['hexagon'] = false;
        }
        if(zoomLevel > 10 && currentLayer !== 'hexagon'){
            currentLayer = 'hexagon';
            layerVisibility['heatmap'] = false;
            layerVisibility['hexagon'] = true;
        }
        render();
    });

    explorer_map.addListener('center_changed', function() {
        let center = explorer_map.getCenter();
        localStorage.setItem('mapCenterLat', center.lat());
        localStorage.setItem('mapCenterLng', center.lng());
    });

    overlay.setMap(explorer_map);


    // Create the search box and link it to the UI element.
    const input = document.getElementById('map-search');
    const searchBox = new google.maps.places.SearchBox(input);

    let debounceTimer;

    explorer_map.addListener('bounds_changed', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            searchBox.setBounds(explorer_map.getBounds());
        }, 500);
    });

    searchBox.addListener('places_changed', function () {
        const places = searchBox.getPlaces();
        if (places.length === 0) {
            return;
        }
        const bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        if (!explorer_map.getBounds().contains(bounds.getNorthEast()) ||
            !explorer_map.getBounds().contains(bounds.getSouthWest())) {
            explorer_map.fitBounds(bounds);
        }
    });

}


function hexagonClicked(object) {
    $.ajax({
        url: dataUrl,
        type: 'GET',
        dataType: 'json',
        data: {
            locations: object.points,
            index: object.index
        },
        success: function (data) {
            populateAndShowModal(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching data: ' + textStatus, errorThrown);
        }
    });
}

function populateAndShowModal(data) {
    $('#hexagon_content').html(data);
    $('#hexagon_modal').modal('show');
}
