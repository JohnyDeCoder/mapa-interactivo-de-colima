//? COSAS QUE HACER
//! CREAR UN CÓDIGO MÁS LIMPIO Y ORDENADO
//! CAMBIAR RUTA DE FETCH

let map = L.map("map", {
  browserPrint: true,
  minZoom: 11,
}).setView([19.241882, -103.726051], 11);

//Agregar tilelAyer mapa base desde openstreetmap
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

document.addEventListener("DOMContentLoaded", function () {
  var overlays = {}; // Objeto para almacenar las capas de overlay

  // Función para que añada la capa al objeto de overlays
  function initializeLayer(checkboxId, layer, label) {
    var checkbox = document.getElementById(checkboxId);
    overlays[label] = layer;

    checkbox.addEventListener("change", function () {
      if (this.checked) {
        layer.addTo(map);
      } else {
        map.removeLayer(overlays[label]); // Remueve la capa del mapa
      }
    });
  }

  // Función para obtener el contenido del popup
  function getPopupContent(feature) {
    let content = [
      "<strong>Clave AGEB:</strong> " + feature.properties["CVEGEO"],
    ];
    if (map.hasLayer(agebsLayer)) {
      content.push(
        "<strong>Población Total:</strong> " +
          feature.properties.POBTOT.toLocaleString("es-MX")
      );
    }
    if (map.hasLayer(agebsLayerM)) {
      content.push(
        "<strong>Población Masculina:</strong> " +
          feature.properties.POBMAS.toLocaleString("es-MX")
      );
    }
    if (map.hasLayer(agebsLayerF)) {
      content.push(
        "<strong>Población Femenina:</strong> " +
          feature.properties.POBFEM.toLocaleString("es-MX")
      );
    }
    return content.join("<br>");
  }

  // Función para añadir el popup a cada feature
  function popupInfo(feature, layer) {
    layer.on({
      add: function () {
        layer.bindPopup(getPopupContent(feature)); // Añade el popup al layer
      },
    });
  }

  // Crear y añadir las capas de overlay al objeto overlays
  let agebsLayer = L.geoJson(agebs, {
    style: style,
    onEachFeature: popupInfo,
  });
  let agebsLayerM = L.geoJson(agebs, {
    style: styleM,
    onEachFeature: popupInfo,
  });
  let agebsLayerF = L.geoJson(agebs, {
    style: styleF,
    onEachFeature: popupInfo,
  });

  initializeLayer("idPoblacionTot", agebsLayer, "Población Total");
  initializeLayer("idPoblacionMasc", agebsLayerM, "Población Masculina");
  initializeLayer("idPoblacionFem", agebsLayerF, "Población Femenina");

  // Función para obtener los datos de las capas activas
  function getActiveLayersData() {
    return {
      claveAGEB: true, // Siempre mostramos la clave AGEB
      poblacionTotal: map.hasLayer(agebsLayer),
      poblacionMasculina: map.hasLayer(agebsLayerM),
      poblacionFemenina: map.hasLayer(agebsLayerF),
    };
  }

  // Función para obtener los datos de un AGEB
  function getAGEBData(feature) {
    return {
      claveAGEB: feature.properties["CVEGEO"],
      poblacionTotal: feature.properties.POBTOT,
      poblacionMasculina: feature.properties.POBMAS,
      poblacionFemenina: feature.properties.POBFEM,
    };
  }

  // Función para construir una tabla HTML con los datos de los AGEBs
  function buildTable(data, activeLayers) {
    let table =
      "<h1>Reporte / AGEBS</h1> <table width='100%' border='1' style='text-align: center;'>";
    table += "<tr>";
    table += "<th>Clave AGEB</th>";
    if (activeLayers.poblacionTotal) table += "<th>Población Total</th>";
    if (activeLayers.poblacionMasculina)
      table += "<th>Población Masculina</th>";
    if (activeLayers.poblacionFemenina) table += "<th>Población Femenina</th>";
    table += "</tr>";

    data.forEach((AGEB) => {
      table += "<tr>";
      table += `<td>${AGEB.claveAGEB}</td>`;
      if (activeLayers.poblacionTotal)
        table += `<td>${AGEB.poblacionTotal}</td>`;
      if (activeLayers.poblacionMasculina)
        table += `<td>${AGEB.poblacionMasculina}</td>`;
      if (activeLayers.poblacionFemenina)
        table += `<td>${AGEB.poblacionFemenina}</td>`;
      table += "</tr>";
    });

    table += "</table>";
    return table;
  }

  // Evento para generar el reporte
  document
    .getElementById("generarReporte")
    .addEventListener("click", function () {
      // Obtener los datos de las capas activas
      let activeLayers = getActiveLayersData();

      // Obtener los datos de los AGEBs
      let AGEBsData = agebs.features.map((feature) => getAGEBData(feature));

      // Construir la tabla HTML con las capas activas
      let tableHTML = buildTable(AGEBsData, activeLayers);

      // Crear un objeto FormData para enviar los datos
      var formData = new FormData();
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
});

// Geocoder buscador en el mapa
var geocoder = L.Control.geocoder({
  defaultMarkGeocode: false,
})
  .on("markgeocode", function (e) {
    var bbox = e.geocode.bbox;
    var poly = L.polygon([
      bbox.getSouthEast(),
      bbox.getNorthEast(),
      bbox.getNorthWest(),
      bbox.getSouthWest(),
    ]).addTo(map);
    map.fitBounds(poly.getBounds());
  })
  .addTo(map);

////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
// Funciones para desplegar la botonera principal  //
////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////

// Función para mostrar/ocultar el menú desplegable al hacer clic en el botón de capas
function toggleDropdown() {
  var dropdown = document.getElementById("dropdown");
  var dropdownMapas = document.getElementById("dropdownSubMapas");
  var dropdownMedicion = document.getElementById("dropdownMedicion");

  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
  ocultarOtrosMenus(dropdown);

  // Ocultar otros menús si están abiertos
  dropdownMapas.style.display = "none";
  dropdownMedicion.style.display = "none";
}

// Función para mostrar/ocultar el menú desplegable al hacer clic en el botón de mapas
function toggleDropdownMapas() {
  var dropdownMapas = document.getElementById("dropdownSubMapas");
  var dropdownMedicion = document.getElementById("dropdownMedicion");

  dropdownMapas.style.display =
    dropdownMapas.style.display === "block" ? "none" : "block";
  dropdownMedicion.style.display = "none"; // Oculta el menú de medicion
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

function getColor(d) {
  return d > 1000
    ? "#800026"
    : d > 500
    ? "#BD0026"
    : d > 200
    ? "#E31A1C"
    : d > 100
    ? "#FC4E2A"
    : d > 50
    ? "#FD8D3C"
    : d > 20
    ? "#FEB24C"
    : d > 10
    ? "#FED976"
    : "#FFEDA0";
}

function getColorMasculina(d) {
  return d > 1000
    ? "#0046FF"
    : d > 500
    ? "#009EFF"
    : d > 200
    ? "#00D1FF"
    : d > 100
    ? "#00FBFF"
    : d > 50
    ? "#73FDFF"
    : d > 20
    ? "#37FDFD"
    : d > 10
    ? "#89F9F9"
    : "#C6FFFF";
}

function getColorFemenina(d) {
  return d > 1000
    ? "#FF00D4"
    : d > 500
    ? "#FF60E4"
    : d > 200
    ? "#FF90EC"
    : d > 100
    ? "#FFBBF3"
    : d > 50
    ? "#FFD0F7"
    : d > 20
    ? "#FFDCF9"
    : d > 10
    ? "#FED976"
    : "#FFEDA0";
}

function style(feature) {
  return {
    fillColor: getColor(feature.properties.POBTOT),
    weight: 2,
    opacity: 1,
    color: "white",
    dashArray: "3",
    fillOpacity: 0.7,
  };
}

function styleM(feature) {
  return {
    fillColor: getColorMasculina(feature.properties.POBMAS),
    weight: 2,
    opacity: 1,
    color: "white",
    dashArray: "3",
    fillOpacity: 0.7,
  };
}

function styleF(feature) {
  return {
    fillColor: getColorFemenina(feature.properties.POBFEM),
    weight: 2,
    opacity: 1,
    color: "white",
    dashArray: "3",
    fillOpacity: 0.7,
  };
}

// Funcionalidad para poder cambiar el tipo de mapa base
// Mapas Base
var worldImagery = L.tileLayer(
  "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
  {
    attribution: "World Imagery",
  }
);

var worldStreetMap = L.tileLayer(
  "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
  {
    attribution: "© OpenStreetMap contributors",
  }
);

var topoMap = L.tileLayer("https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png", {
  attribution: "© OpenTopoMap contributors",
});

worldImagery.addTo(map); // Mapa por defecto

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
var coordinatesContainer = L.DomUtil.create('div', 'coordinates-container');
coordinatesContainer.style.position = 'absolute';
coordinatesContainer.style.bottom = '40px';
coordinatesContainer.style.left = '20px';
coordinatesContainer.style.backgroundColor = 'white';
coordinatesContainer.style.padding = '5px';
coordinatesContainer.style.borderRadius = '5px';
document.getElementById('map').appendChild(coordinatesContainer);

// Manejar el evento mousemove
map.on('mousemove', function (e) {
  // Actualizar las coordenadas en el contenedor
  coordinatesContainer.innerHTML = 'Latitud: ' + e.latlng.lat.toFixed(6) + '<br>Longitud: ' + e.latlng.lng.toFixed(6);
});

L.control.scale({
  position: 'bottomleft',
  metric: true,
  imperial: false,
  units: 'kilometers',

}).addTo(map);