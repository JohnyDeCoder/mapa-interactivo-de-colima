let map = L.map("map", {
  minZoom: 11,
}).setView([19.241882, -103.726051], 11);

//Agregar titleLayer mapa base desde openstreetmap
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

// Geocoder buscador en el mapa
let geocoder = L.Control.geocoder({
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

// Objeto para almacenar las capas de overlay
let overlays = {};

// Lista de nombres de capas de AGEBs
const LABELED_LIST = {
  claveAGEB: "Clave AGEB",
  POBTOT: "Población Total",
  POBMAS: "Población Masculina",
  POBFEM: "Población Femenina",
};

// Lista de capas de AGEBs
const AGEBS_LIST = {
  POBTOT: {
    overlayLayer: () => {
      return L.geoJson(agebsGeoJson, {
        style: function (feature) {
          return {
            fillColor: AGEBS_LIST.POBTOT.colorScale(feature.properties.POBTOT),
            weight: 2,
            opacity: 1,
            color: "white",
            dashArray: "3",
            fillOpacity: 0.7,
          };
        },
        onEachFeature: popupInfo,
      });
    },
    colorScale: (dim) => {
      return dim > 1000
        ? "#800026"
        : dim > 500
        ? "#BD0026"
        : dim > 200
        ? "#E31A1C"
        : dim > 100
        ? "#FC4E2A"
        : dim > 50
        ? "#FD8D3C"
        : dim > 20
        ? "#FEB24C"
        : dim > 10
        ? "#FED976"
        : "#FFEDA0";
    },
  },
  POBMAS: {
    overlayLayer: () => {
      return L.geoJson(agebsGeoJson, {
        style: (feature) => {
          return {
            fillColor: AGEBS_LIST.POBMAS.colorScale(feature.properties.POBMAS),
            weight: 2,
            opacity: 1,
            color: "white",
            dashArray: "3",
            fillOpacity: 0.7,
          };
        },
        onEachFeature: popupInfo,
      });
    },
    colorScale: (dim) => {
      return dim > 1000
        ? "#0046FF"
        : dim > 500
        ? "#009EFF"
        : dim > 200
        ? "#00D1FF"
        : dim > 100
        ? "#00FBFF"
        : dim > 50
        ? "#73FDFF"
        : dim > 20
        ? "#37FDFD"
        : dim > 10
        ? "#89F9F9"
        : "#C6FFFF";
    },
  },
  POBFEM: {
    overlayLayer: () => {
      return L.geoJson(agebsGeoJson, {
        style: (feature) => {
          return {
            fillColor: AGEBS_LIST.POBFEM.colorScale(feature.properties.POBFEM),
            weight: 2,
            opacity: 1,
            color: "white",
            dashArray: "3",
            fillOpacity: 0.7,
          };
        },
        onEachFeature: popupInfo,
      });
    },
    colorScale: (dim) => {
      return dim > 1000
        ? "#FF00D4"
        : dim > 500
        ? "#FF60E4"
        : dim > 200
        ? "#FF90EC"
        : dim > 100
        ? "#FFBBF3"
        : dim > 50
        ? "#FFD0F7"
        : dim > 20
        ? "#FFDCF9"
        : dim > 10
        ? "#FED976"
        : "#FFEDA0";
    },
  },
};

// Inicializar las capas de overlay

// Población
initializeLayer("checkboxPobTot", AGEBS_LIST.POBTOT.overlayLayer(), "POBTOT");

initializeLayer("checkboxPobMas", AGEBS_LIST.POBMAS.overlayLayer(), "POBMAS");

initializeLayer("checkboxPobFem", AGEBS_LIST.POBFEM.overlayLayer(), "POBFEM");

// Educación
// ...

// Fin de la inicialización de las capas de overlay

// Función para que añada la capa al objeto de overlays
function initializeLayer(checkboxId, overlayLayer, key) {
  let checkbox = document.getElementById(checkboxId);
  overlays[key] = overlayLayer;

  checkbox.addEventListener("change", function () {
    if (this.checked) {
      overlayLayer.addTo(map);
    } else {
      map.removeLayer(overlays[key]); // Remueve la capa del mapa
    }
  });
}

// Funciones Extras

// Función para mostrar la información de las AGEBS
function popupInfo(feature, layer) {
  layer.on({
    // Evento click
    click: function (e) {
      let { activeLayers, dataLayers } = getActiveLayersAndData(
        [feature],
        overlays
      );

      let popupContent = "<h3>Información del AGEB</h3>";
      popupContent += "<ul>"; // Inicio de la lista
      for (const key in activeLayers) {
        // Iterar sobre las capas activas y añadir los datos a la lista
        if (activeLayers[key]) {
          // Si la capa está activa
          popupContent += `<li><strong>${LABELED_LIST[key]}:</strong> ${dataLayers[0][key]}</li>`; // Añadir el dato a la lista
        }
      }
      popupContent += "</ul>"; // Fin de la lista

      e.target.bindPopup(popupContent).openPopup(); // Mostrar el popup
    },
  });
}

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
    fetch("../../../mapa-interactivo-de-colima/assets/php/createReport.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.blob())
      .then((blob) => {
        // Crear un URL temporal para el blob
        var url = window.URL.createObjectURL(blob);
        // Abrir el PDF en una nueva pestaña
        window.open(url, "_blank");
      })
      .catch((error) => console.error("Error:", error));
  });

// Función para obtener las capas activas y los datos de las AGEBS
function getActiveLayersAndData(features, overlays) {
  let activeLayers = {
    claveAGEB: true, // Siempre mostramos la clave AGEB
  };

  let dataLayers = features.map((feature) => {
    // Iterar sobre las características y obtener los datos de las capas
    let agebsData = {
      claveAGEB: feature.properties["CVEGEO"],
    };

    // Iterar sobre las capas de AGEBs
    for (const agebLayer in overlays) {
      // Verificar que la propiedad sea propia del objeto
      if (overlays.hasOwnProperty(agebLayer)) {
        // Verificar si la capa está activa en el mapa y añadir el resultado
        activeLayers[agebLayer] = map.hasLayer(overlays[agebLayer]);

        // Obtener los datos de la capa y añadirlos al objeto agebsData
        if (activeLayers[agebLayer] && feature && feature.properties) {
          agebsData[agebLayer] = feature.properties[agebLayer];
        }
      }
    }

    return agebsData;
  });

  return { activeLayers, dataLayers };
}

// Función para construir la tabla HTML
function buildTable(activeLayers, dataLayers) {
  let table =
    "<h1>Reporte / AGEBS</h1> <table width='100%' border='1' style='text-align: center;'>";
  table += "<tr>";

  // Iterar sobre las capas activas y añadir encabezados
  for (const agebLayer in activeLayers) {
    if (activeLayers.hasOwnProperty(agebLayer) && activeLayers[agebLayer]) {
      table += `<th>${LABELED_LIST[agebLayer]}</th>`;
    }
  }

  table += "</tr>";

  // Iterar sobre los elementos de dataLayers
  for (const agebLayer in dataLayers) {
    if (dataLayers.hasOwnProperty(agebLayer)) {
      const AGEB = dataLayers[agebLayer];
      table += "<tr>";

      // Iterar sobre las capas activas y añadir datos formateados
      for (const activeLayer in activeLayers) {
        if (
          activeLayers.hasOwnProperty(activeLayer) &&
          activeLayers[activeLayer]
        ) {
          const formattedValue = AGEB[activeLayer]
            ? AGEB[activeLayer].toLocaleString("en-US")
            : "N/A";
          table += `<td>${formattedValue}</td>`;
        }
      }

      table += "</tr>";
    }
  }

  table += "</table>";

  return table;
}

// Función para mostrar/ocultar el menú desplegable al hacer clic en el botón de capas
function toggleDropdown() {
  var dropdown = document.getElementById("dropdown");
  var dropdownMapas = document.getElementById("dropdownSubMapas");

  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
  ocultarOtrosMenus(dropdown);

  // Ocultar otros menús si están abiertos
  dropdownMapas.style.display = "none";
}

// Función para mostrar/ocultar el menú desplegable al hacer clic en el botón de mapas
function toggleDropdownMapas() {
  var dropdownMapas = document.getElementById("dropdownSubMapas");

  dropdownMapas.style.display =
    dropdownMapas.style.display === "block" ? "none" : "block";
  ocultarOtrosMenus(dropdownMapas);
}

// Función para mostrar/ocultar el menú desplegable al hacer clic en el botón de medicion
function toggleDropdownMedicion() {
  var dropdownMedicion = document.getElementById("dropdownMedicion");
  var dropdownMapas = document.getElementById("dropdownSubMapas");

  dropdownMedicion.style.display =
    dropdownMedicion.style.display === "block" ? "none" : "block";
  dropdownMapas.style.display = "none"; // Oculta el menú de mapas
  ocultarOtrosMenus(dropdownMedicion);
}

function toggleDropdown1() {
  var dropdown1 = document.getElementById("dropdown1");
  dropdown1.style.display =
    dropdown1.style.display === "block" ? "none" : "block";
}

function toggleDropdown2() {
  var dropdown2 = document.getElementById("dropdown2");
  dropdown2.style.display =
    dropdown2.style.display === "block" ? "none" : "block";
}

function toggleDropdown3() {
  var dropdown3 = document.getElementById("dropdown3");
  dropdown3.style.display =
    dropdown3.style.display === "block" ? "none" : "block";
}

// Función para ocultar todos los menús excepto el proporcionado
function ocultarOtrosMenus(menuActual) {
  var menus = document.querySelectorAll(
    ".dropdown, .dropdown1, .dropdown2, .dropdown3, .dropdownSubMapas"
  );
  menus.forEach(function (menu) {
    if (menu !== menuActual) {
      menu.style.display = "none";
    }
  });
}

function ocultarMenu() {
  var dropdown1 = document.getElementById("dropdown1");
  var dropdown2 = document.getElementById("dropdown2");
  var dropdown3 = document.getElementById("dropdown3");
  var dropdownSubMapas = document.getElementById("dropdownSubMapas");
  dropdown1.style.display = "none";
  dropdown2.style.display = "none";
  dropdown3.style.display = "none";
  dropdownSubMapas.style.display = "none";
}

document.addEventListener("DOMContentLoaded", ocultarMenu);

// Mapas Base

let worldImagery = L.tileLayer(
  "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
  {
    attribution: "World Imagery",
  }
);

let worldStreetMap = L.tileLayer(
  "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
  {
    attribution: "© OpenStreetMap contributors",
  }
);

worldImagery.addTo(map); // Mapa por defecto

let topoMap = L.tileLayer("https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png", {
  attribution: "© OpenTopoMap contributors",
});

function cambiarMapa(tipo) {
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

// Funcionalidad para imprimir mapa
L.control.browserPrint().addTo(map);

// Agregar un contenedor para mostrar las coordenadas
var coordinatesContainer = L.DomUtil.create("div", "coordinates-container");
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

L.control
  .scale({
    position: "bottomleft",
    metric: true,
    imperial: false,
    units: "kilometers",
  })
  .addTo(map);
