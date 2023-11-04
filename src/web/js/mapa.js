// Crea un mapa Leaflet
var map = L.map("map", {
  minZoom: 11, // Nivel de zoom mínimo permitido
}).setView([-103.72714, 19.24997], 11);

// Agrega una capa de mapa base
L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// Carga el archivo KML que contiene los polígonos
fetch("Pruebas1.kml")
  .then((response) => response.text())
  .then((kml) => {
    // Convierte el KML en una capa de polígonos en Leaflet
    var polygons = omnivore.kml.parse(kml);

    // Define un objeto que mapea nombres de polígonos a colores
    var colorMapping = {
      "Mancha 1": "red",
      "Mancha 2": "green",
      "Mancha 3": "blue",
    };

    // Aplica el estilo personalizado basado en la categoría
    polygons.setStyle(function (feature) {
      var nombre = feature.properties.name;
      var fillColor = colorMapping[nombre] || "rgb(0,0,0,0)"; // Borde del mapa

      return {
        fillColor: fillColor,
        color: "black",
        weight: 2,
        opacity: 1,
        fillOpacity: 0.5,
      };
    });

    // Función para habilitar/deshabilitar un polígono
    function togglePolygon(polygonName) {
      if (polygons) {
        polygons.eachLayer(function (layer) {
          if (layer.feature.properties.name === polygonName) {
            if (map.hasLayer(layer)) {
              map.removeLayer(layer);
            } else {
              map.addLayer(layer);
            }
          }
        });
      }
    }

    // Agregar eventos de clic a los botones
    document
      .getElementById("toggleMancha1")
      .addEventListener("click", function () {
        togglePolygon("0600200011091");
      });

    document
      .getElementById("toggleMancha2")
      .addEventListener("click", function () {
        togglePolygon("Mancha 2");
      });

    document
      .getElementById("toggleMancha3")
      .addEventListener("click", function () {
        togglePolygon("Mancha 3");
      });

    document
      .getElementById("toggleMunicipio")
      .addEventListener("click", function () {
        togglePolygon("Municipio Colima");
      });

    // Agrega los polígonos al mapa
    polygons.addTo(map);

    // Ajusta la vista del mapa para que muestre todos los polígonos
    map.fitBounds(polygons.getBounds());
  });
