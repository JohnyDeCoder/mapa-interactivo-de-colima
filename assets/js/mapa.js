// Crea un mapa Leaflet
var map = L.map("map", {
  minZoom: 11, // Nivel de zoom mínimo permitido
}).setView([-103.72714, 19.24997], 11);

// Agrega una capa de mapa base
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

/* El código `var control = L.Control.geocoder({...}).addTo(map);` está creando un control
geocodificador y agregándolo al mapa del Folleto. */
var control = L.Control.geocoder({
  position: "topleft",
  defaultMarkGeocode: true,
  geocoder: L.Control.Geocoder.mapbox(
    "pk.eyJ1Ijoic3Bpbm9uNjQiLCJhIjoiY2xvbjgwbmlqMHFmcDJrczZncGs1ejRnNCJ9._i-bNrmSZgkTubn6s64-cw",
    {
      proximity: L.latLng(19.2433, -103.7242), // Centro de Colima
    }
  ),
}).addTo(map);

/* El código `control.on('markgeocode', function (e) { map.setView(e.geocode.center, 15); });` está
agregando un detector de eventos al control del geocodificador. */
control.on("markgeocode", function (e) {
  map.setView(e.geocode.center, 15);
});

// Carga el archivo GeoJSON que contiene los polígonos
fetch("agebs.json") // Reemplaza 'Pruebas1.geojson' con la URL de tu archivo GeoJSON
  .then((response) => response.json()) // Utiliza response.json() para analizar el archivo GeoJSON
  .then((data) => {
    // Convierte el GeoJSON en una capa de polígonos en Leaflet
    var polygons = L.geoJSON(data, {
      style: function (feature) {
        var POBTOT = feature.properties.POBTOT;
        var nombre = feature.properties.name;
        var fillColor;

        // Define el color basado en el valor de "POBTOT"
        if (nombre === "Municipio Colima") {
          fillColor = "transparent"; // Establece el relleno como transparente
        }

        if (POBTOT === 3 && nombre === "060020001134A") {
          fillColor = "black";
        }

        if (POBTOT <= 10) {
          fillColor = "purple";
        } else if (POBTOT <= 30 && POBTOT >= 11) {
          fillColor = "green";
        }

        return {
          fillColor: fillColor,
          color: "blue",
          weight: 0.5,
          opacity: 1,
          fillOpacity: 0.5,
        };
      },
    });

    // Agrega los polígonos al mapa
    polygons.addTo(map);

    // Ajusta la vista del mapa para que muestre todos los polígonos
    map.fitBounds(polygons.getBounds());
  });
