// Importar el GeoJSON de AGEBS y Colima
import { agebsGeoJson } from "../json/agebs";
import { colimaGeoJson } from "../json/colima";

// Importar las constantes
import { AGEBS_LIST } from "./constants";

// Importar las funciones de las capas
import {
  overlaysIsEmpty,
  initializeLayer,
  getActiveLayersAndData,
} from "./layersFunctions";

// Importar las funciones para crear la tabla
import { buildTable } from "./tableReport";

export const bounds = L.geoJson(colimaGeoJson).getBounds(), // Obtener los límites del GeoJSON de Colima
  url = window.location.href, // Obtener la URL de la página
  map = L.map("map", {
    minZoom: 11, // minZoom: 11 (default)
    maxZoom: 16, // maxZoom: 18 (default)
    maxBounds: bounds, // Para que el mapa no se salga de los límites
    maxBoundsViscosity: 1,
    attributionControl: true, // Para que no aparezca el mensaje de Leaflet
    doubleClickZoom: false, // Para que no se pueda hacer zoom con doble click
    zoomControl: true, // Control de zoom
    zoomSnap: 1, // Para que el zoom sea más suave (default: 0.1)
    zoomDelta: 1, // Para que el zoom sea más suave (default: 0.1)
  }).setView(bounds.getCenter(), 11); // Centrar el mapa en los límites del GeoJSON de Colima

// Objeto para almacenar las capas de overlay
export let overlays = {};

//Agregar titleLayer mapa base desde openstreetmap
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// Geocoder buscador en el mapa
L.Control.geocoder({
  defaultMarkGeocode: false,
})
  .on("markgeocode", function (e) {
    let bbox = e.geocode.bbox;
    let poly = L.polygon([
      bbox.getSouthEast(),
      bbox.getNorthEast(),
      bbox.getNorthWest(),
      bbox.getSouthWest(),
    ]).addTo(map);
    map.fitBounds(poly.getBounds());
  })
  .addTo(map);

// Agregar el GeoJSON de Colima
L.geoJson(colimaGeoJson, {
  style: () => {
    return {
      opacity: 1,
      color: "black",
      dashArray: "5",
      fillOpacity: 0,
    };
  },
}).addTo(map);

// // // Agregar el GeoJSON de AGEBS
// // L.geoJson(agebsGeoJson, {
// //   style: () => {
// //     return {
// //       opacity: 1,
// //       color: "black",
// //       dashArray: "5",
// //       fillOpacity: 0,
// //     };
// //   },
// // }).addTo(map);

/* El código anterior crea una capa Leaflet GeoJSON llamada "agebLayerTooltip". Esta capa se completa
con datos de la variable `agebsGeoJson`. */
let agebLayerTooltip = L.geoJson(agebsGeoJson, {
  onEachFeature: function (feature, layer) {
    if (feature.properties) {
      // Si la característica tiene propiedades
      const claveAGEB = feature.properties.CVEGEO
        ? feature.properties.CVEGEO.slice(-4)
        : "N/A"; // Obtener la clave AGEB

      // Añadir el tooltip
      layer
        .bindTooltip(
          // Mostrar el tooltip
          "Clave AGEB" + "<br>" + "<strong>" + claveAGEB + "</strong>",
          {
            permanent: true, // El tooltip se muestra permanentemente
            direction: "top", // El tooltip se muestra en la parte superior
            className: "tooltip", // Añadir la clase al tooltip
          }
        )
        .addTo(map); // Añadir el tooltip al mapa
    }
    layer.closeTooltip(); // Ocultar el tooltip
  },
  style: {
    // Estilo de la capa
    fillColor: "#000000ff", // Color de fondo de la capa
    opacity: 0, // Opacidad de la capa
    fillOpacity: 0, // Opacidad del relleno de la capa
  },
});

const dropdownDiv = document.getElementById("dropdown"), // Obtener el div del menú desplegable
  checkboxes = dropdownDiv.querySelectorAll("input[type='checkbox']"); // Obtener los checkboxes del menú desplegable

// Iterar sobre los checkboxes para inicializar las capas de overlay
checkboxes.forEach((checkbox) => {
  if (AGEBS_LIST[checkbox.id]) {
    // Inicializar la capa de overlay
    initializeLayer(
      checkbox.id,
      AGEBS_LIST[checkbox.id].overlayLayer(),
      checkbox.id
    );
  }
});

// Funcionalidad para imprimir mapa
L.control.browserPrint().addTo(map);

// Agregar un contenedor para mostrar las coordenadas
let coordinatesContainer = L.DomUtil.create("div", "coordinates-container");
coordinatesContainer.style.position = "absolute";
coordinatesContainer.style.bottom = "40px";
coordinatesContainer.style.left = "20px";
coordinatesContainer.style.backgroundColor = "white";
coordinatesContainer.style.padding = "5px";
coordinatesContainer.style.borderRadius = "5px";
document.getElementById("map").appendChild(coordinatesContainer);

// Manejar el evento mousemove
map.on("mousemove", function (e) {
  // Actualizar las coordenadas en el contenedor
  coordinatesContainer.innerHTML =
    "Latitud: " +
    e.latlng.lat.toFixed(6) +
    "<br>Longitud: " +
    e.latlng.lng.toFixed(6);
});

/* El código anterior agrega un control de escala a un mapa en JavaScript. El control de escala está
ubicado en la esquina inferior izquierda del mapa. Está configurado para mostrar unidades métricas
(kilómetros) y no muestra unidades imperiales. */
L.control
  .scale({
    maxWidth: 200, // Ancho máximo del control de escala
    position: "bottomleft", // Posición del control de escala
    metric: true, // Mostrar unidades métricas
    imperial: false, // No mostrar unidades imperiales
    units: "kilometers", // Las unidades se muestran en kilómetros
    updateWhenIdle: true, // Actualizar la escala solo cuando el mapa esté inactivo
  })
  .addTo(map);

// Añadir el evento zoomend al mapa para controlar la visibilidad de los tooltips
map.on("zoomend", function () {
  let currentZoom = map.getZoom(),
    zoomTooltips = 14;

  if (currentZoom >= zoomTooltips && !overlaysIsEmpty()) {
    // Mostrar los tooltips
    agebLayerTooltip.eachLayer(function (layer) {
      layer.openTooltip();
    });
  } else {
    // Ocultar los tooltips
    agebLayerTooltip.eachLayer(function (layer) {
      layer.closeTooltip();
    });
  }
});

// Mapas Base

const worldImagery = L.tileLayer(
  "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
  {
    attribution: "World Imagery",
  }
);

const worldStreetMap = L.tileLayer(
  "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
  {
    attribution: "© OpenStreetMap contributors",
  }
);

worldImagery.addTo(map); // Mapa por defecto

const topoMap = L.tileLayer(
  "https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png",
  {
    attribution: "© OpenTopoMap contributors",
  }
);

// DOM para el control de capas

/**
 * El código JavaScript anterior define una función que genera un informe recuperando capas activas y
 * datos de un mapa, creando una tabla HTML y enviando los datos a un archivo PHP para su posterior
 * procesamiento.
 * @param features - Un conjunto de funcionalidades que representan las AGEBS (Áreas Geoestadísticas
 * Básicas) en formato GeoJSON. Cada característica representa una AGEBS específica y contiene
 * propiedades como "CVEGEO" (claveAGEB) y otras capas de datos.
 * @param overlays - El parámetro "overlays" es un objeto que contiene las diferentes capas del mapa.
 * Cada capa está representada por un par clave-valor, donde la clave es el nombre de la capa y el
 * valor es el objeto de la capa en sí.
 * @returns La función `getActiveLayersAndData` devuelve un objeto con dos propiedades: `activeLayers`
 * y `dataLayers`.
 */
document
  .getElementById("generarReporte")
  .addEventListener("click", function () {
    // Variables para almacenar las capas activas, los datos de las AGEBS, el HTML de la tabla y el FormData para enviar los datos al archivo PHP
    let { activeLayers, dataLayers } = getActiveLayersAndData(
        agebsGeoJson.features.map((feature) => feature),
        overlays
      ),
      tableHTML = buildTable(activeLayers, dataLayers),
      formData = new FormData();

    // Añadir el HTML de la tabla al FormData
    formData.append("tablaAGEBs", tableHTML);

    // Enviar los datos al archivo PHP mediante POST
    fetch(url + "/assets/php/createReport.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        // Obtener la respuesta del servidor
        if (!response.ok) {
          // Si la respuesta no es correcta
          throw new Error("Network response was not ok"); // Lanzar un error
        }
        return response.blob(); // Devolver la respuesta como un blob
      })
      .then((blob) => {
        // Crear un URL temporal para el blob
        var url = window.URL.createObjectURL(blob);
        // Abrir el PDF en una nueva pestaña
        window.open(url, "_blank");
      })
      .catch((error) => console.error("Error:", error));
  });

/* El código anterior utiliza JavaScript para ocultar varios elementos desplegables en una página web.
Está utilizando el detector de eventos `DOMContentLoaded` para esperar a que el documento HTML
termine de cargarse antes de ejecutar el código. */
document.addEventListener("DOMContentLoaded", () => {
  var dropdown1 = document.getElementById("dropdown1");
  var dropdown2 = document.getElementById("dropdown2");
  var dropdown3 = document.getElementById("dropdown3");
  var dropdownSubMapas = document.getElementById("dropdownSubMapas");
  dropdown1.style.display = "none";
  dropdown2.style.display = "none";
  dropdown3.style.display = "none";
  dropdownSubMapas.style.display = "none";
});

/**
 * La función "cambiarMapa" cambia la capa del mapa base en un mapa de Folleto según el tipo de
 * entrada.
 * @param tipo - El parámetro "tipo" es una cadena que representa el tipo de mapa al que se cambiará.
 * Puede tener uno de los siguientes valores: "WorldImagery", "WorldStreetMap" o "TopoMap".
 */
export function cambiarMapa(tipo) {
  // Eliminar solo las capas correspondientes al mapa base anterior
  switch (tipo) {
    case "WorldImagery":
      map.eachLayer(function (layer) {
        if (layer instanceof L.TileLayer) {
          map.removeLayer(layer);
        }
      });
      worldImagery.addTo(map);
      break;
    case "WorldStreetMap":
      map.eachLayer(function (layer) {
        if (layer instanceof L.TileLayer) {
          map.removeLayer(layer);
        }
      });
      worldStreetMap.addTo(map);
      break;
    case "TopoMap":
      map.eachLayer(function (layer) {
        if (layer instanceof L.TileLayer) {
          map.removeLayer(layer);
        }
      });
      topoMap.addTo(map);
      break;
  }
}
