points = points
    .map(point => [
        point[0] !== null ? parseFloat(point[0]) : null,
        point[1] !== null ? parseFloat(point[1]) : null
    ])
    .filter(point => {
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
    });

const geoJsonFeatures = points.map(point => ({
    type: 'Feature',
    properties: {},
    geometry: {
        type: 'Point',
        coordinates: [point[0], point[1]]
    }
}));

// Creating a GeoJSON object
const geoJsonObject = {
    type: 'FeatureCollection',
    features: geoJsonFeatures
};


let defaultZoom = 8;
let defaultCenter = (points && points.length > 0) ? [points[0][1], points[0][0]] : [-0.1278, 51.5074];

// Check if saved zoom level and center exist in localStorage
let savedZoom = parseInt(localStorage.getItem('mapZoomLevel')) || defaultZoom;
let savedCenter = localStorage.getItem('mapCenter') ? JSON.parse(localStorage.getItem('mapCenter')) : defaultCenter;

mapboxgl.accessToken = accessToken;

const explorer_map = new mapboxgl.Map({
    container: 'explorer-map',
    style: 'mapbox://styles/mapbox/light-v10', // Map style
    center: savedCenter,
    zoom: savedZoom,
});
var nav = new mapboxgl.NavigationControl();
explorer_map.addControl(nav, 'top-right');

explorer_map.addControl(
    new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl
    }), 'top-left'
);


const tooltip = document.getElementById('tooltip');

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

explorer_map.on('zoomend', function () {
    const zoomLevel = explorer_map.getZoom();
    localStorage.setItem('mapZoomLevel', zoomLevel);
    setVisibility(zoomLevel);
});

explorer_map.on('moveend', function () {
    let center = explorer_map.getCenter();
    localStorage.setItem('mapCenter', JSON.stringify([center.lng, center.lat]));
});

explorer_map.on('load', function () {
    explorer_map.addSource("miners_source", {
        type: "geojson",
        data: geoJsonObject
    });

    const hexagonLayer = new deck.MapboxLayer({
        id: 'hexagon-layer',
        data: points,
        type: deck.HexagonLayer,
        getPosition: d => [d[1], d[0]],
        colorRange: [
            [228, 0, 0, 100],
        ],
        extruded: false,
        pickable: true,
        radius: 1500,
        layout:{
            visibility : 'visible'
        },
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
    });
    const heatmapLayer = new deck.MapboxLayer({
        id: 'heatmap-layer',
        data: points,
        type: deck.HeatmapLayer,
        getPosition: d => [d[1], d[0]],
        layout:{
            visibility : 'visible'
        },
    })

    explorer_map.addLayer(hexagonLayer);
    explorer_map.addLayer(heatmapLayer);

    setVisibility();
});

let currentLayer = false;
function setVisibility(zoomLevel = explorer_map.getZoom()) {
    console.log(zoomLevel)
    if (zoomLevel <= 10 && (currentLayer !== 'heatmap' || !currentLayer)) {
        currentLayer = 'heatmap';
        explorer_map.setLayoutProperty('hexagon-layer', 'visibility', 'none');
        explorer_map.setLayoutProperty('heatmap-layer', 'visibility', 'visible');
    }
    if (zoomLevel > 10 && (currentLayer !== 'hexagon' || !currentLayer)) {
        currentLayer = 'hexagon';
        explorer_map.setLayoutProperty('hexagon-layer', 'visibility', 'visible');
        explorer_map.setLayoutProperty('heatmap-layer', 'visibility', 'none');
    }
}
