const MAPBOX_TOKEN = access_token; // Replace with your Mapbox token

const INITIAL_VIEW_STATE = {
    latitude: 51.505,
    longitude: -0.09,
    zoom: 12,
    bearing: 0,
    pitch: 45
};

const data = [
    // Sample data
    {latitude: 51.505, longitude: -0.09, count: 3},
    {latitude: 52.505, longitude: -0.09, count: 3},
    {latitude: 53.505, longitude: -0.09, count: 3},
    {latitude: 54.505, longitude: -0.09, count: 3},
    // ... more data points
];

const hexagonLayer = new HexagonLayer({
    id: 'hexagon-layer',
    data: data,
    getPosition: d => [d.longitude, d.latitude],
    radius: 250,
    elevationScale: 4,
    extruded: true,
    coverage: 0.88,
});

const deck = new Deck({
    canvas: 'map',
    initialViewState: {
        longitude: 67.0011,
        latitude: 24.8607,
        zoom: 13,
        pitch: 0,
        bearing: 0
    },
    controller: true,
    layers: [hexagonLayer],
});
