points = points.map(point => [parseFloat(point[0]), parseFloat(point[1])]);

const {MapboxLayer, HexagonLayer, HeatmapLayer} = deck;

// Initialize Mapbox
mapboxgl.accessToken = accessToken;
const explorer_map = new mapboxgl.Map({
    container: 'explorer-map',
    style: 'mapbox://styles/mapbox/light-v11',
    center: (points && points.length > 0) ? [points[0][1], points[0][0]] : [51.5074, -0.1278],
    zoom:8,
    minZoom: 6,
});
const geocoder = new MapboxGeocoder({
    accessToken: mapboxgl.accessToken,
    mapboxgl: mapboxgl,
    placeholder: "Search location...",
});
console.log("Points:", points);

explorer_map.on('load', () => {
    const firstLabelLayerId = getFirstSymbolLayerId();
    addLayer('hexagon-layer', HexagonLayer, addHexagonLayerProps());
    addLayer('heatmap-layer', HeatmapLayer, addHeatmapLayerProps());
    registerZoomListener();
    explorer_map.addControl(new mapboxgl.NavigationControl(), 'top-right');
    explorer_map.addControl(geocoder, 'top-left');
});


function getFirstSymbolLayerId() {
    return explorer_map.getStyle().layers.find(layer => layer.type === 'symbol').id;
}

function addLayer(layerId, LayerType, layerProps) {
    if (!explorer_map.getLayer(layerId)) {
        explorer_map.addLayer(new MapboxLayer({id: layerId, type: LayerType, ...layerProps}));
    }
}

function addHexagonLayerProps() {
    return {
        data: points,
        getPosition: d => [d[1], d[0]],
        radius: 2000,
        pickable: true,
        onClick: handleHexagonClick,
        extruded: true,
        colorRange:[
            [228, 0, 0,200],
        ],
    };
}

function addHeatmapLayerProps() {
    return {
        data: points,
        getPosition: d => [d[1], d[0]],
        getWeight: 1,
        radiusPixels: 40,
        intensity: 1,
        threshold: 0.03,
    };
}

function registerZoomListener() {
    explorer_map.on('zoomend', () => {
        const currentZoom = explorer_map.getZoom();
        console.log(currentZoom);
    });
}

function removeLayer(layerId) {
    if (explorer_map.getLayer(layerId)) {
        explorer_map.removeLayer(layerId);
    }
}

function handleHexagonClick(info) {
    if (info.object) {
        // Your existing logic here
        // ...
    }
}
