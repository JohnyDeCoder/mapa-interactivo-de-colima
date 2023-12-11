const bounds = L.geoJson(colimaGeoJson).getBounds(), // Obtener los límites del GeoJSON de Colima
  url = window.location.href; // Obtener la URL de la página

// Objeto para almacenar las capas de overlay
let overlays = {};

let map = L.map("map", {
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

//Agregar titleLayer mapa base desde openstreetmap
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution:
    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
}).addTo(map);

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

// Lista de nombres de capas de AGEBs
const LABELED_LIST = {
    claveAGEB: {
      label: "Clave AGEB",
      unit: "",
    },
    POBTOT: {
      label: "Población Total",
      unit: "hab.",
    },
    POBMAS: {
      label: "Población Masculina",
      unit: "hab.",
    },
    POBFEM: {
      label: "Población Femenina",
      unit: "hab.",
    },
  },
  // Lista de capas de AGEBs
  AGEBS_LIST = {
    POBTOT: {
      overlayLayer: () => {
        return L.geoJson(agebsGeoJson, {
          style: function (feature) {
            return returnStyle(
              AGEBS_LIST.POBTOT.colorScale(feature.properties.POBTOT)
            );
          },
          onEachFeature: handleOnEachFeature,
        });
      },
      colorScale: (dim) => {
        return getColorByDim(dim, generateColorScale("YlOrRd", 8));
      },
    },
    POBMAS: {
      overlayLayer: () => {
        return L.geoJson(agebsGeoJson, {
          style: (feature) => {
            return returnStyle(
              AGEBS_LIST.POBMAS.colorScale(feature.properties.POBMAS)
            );
          },
          onEachFeature: handleOnEachFeature,
        });
      },
      colorScale: (dim) => {
        return getColorByDim(dim, generateColorScale("YlGnBu", 8));
      },
    },
    POBFEM: {
      overlayLayer: () => {
        return L.geoJson(agebsGeoJson, {
          style: (feature) => {
            return returnStyle(
              AGEBS_LIST.POBFEM.colorScale(feature.properties.POBFEM)
            );
          },
          onEachFeature: handleOnEachFeature,
        });
      },
      colorScale: (dim) => {
        return getColorByDim(dim, generateColorScale("RdPu", 8));
      },
    },
  },
  dropdownDiv = document.getElementById("dropdown"), // Obtener el div del menú desplegable
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

/**
 * La función `initializeLayer` agrega o elimina una capa superpuesta a un mapa según el estado de una
 * casilla de verificación.
 * @param checkboxId - El ID del elemento de la casilla de verificación que activará el evento de
 * cambio.
 * @param overlayLayer - El parámetro overlayLayer es la capa que desea agregar o eliminar del mapa.
 * Podría ser una capa de marcador, una capa de mosaico, una capa de polígono o cualquier otro tipo de
 * capa que se pueda agregar a un mapa.
 * @param key - El parámetro clave es un identificador único para la capa superpuesta. Se utiliza para
 * almacenar y recuperar la capa de superposición en el objeto de superposición.
 */
function initializeLayer(checkboxId, overlayLayer, key) {
  let checkbox = document.getElementById(checkboxId);

  checkbox.addEventListener("change", function () {
    if (this.checked) {
      overlays[key] = overlayLayer;
      overlayLayer.addTo(map);
    } else {
      map.removeLayer(overlays[key]); // Remueve la capa del mapa
      delete overlays[key]; // Elimina la capa del objeto overlays
    }
  });
}

/**
 * La función genera una escala de colores utilizando un color base y un número específico de pasos.
 * @param baseColor - El parámetro baseColor es un código de color hexadecimal que sirve como punto de
 * partida para generar la escala de colores.
 * @param steps - El parámetro "pasos" representa la cantidad de colores que desea generar en la escala
 * de colores. Determina la granularidad o el número de pasos entre el color base y el color final en
 * la escala.
 * @returns una matriz de colores generada usando Chroma.js con el color base especificado y el número
 * de pasos.
 */
function generateColorScale(baseColor, steps) {
  // Para obtener las paletas de colores de brewer visite: https://colorbrewer2.org/

  // Código anterior para generar la escala de colores utilizando un color hexadecimal base
  // chroma.scale(["white", baseColor]).mode("lch").colors(steps);

  // Generar la escala de colores utilizando Chroma.js con los colores de Brewer
  return chroma.scale(baseColor).colors(steps);
}

/**
 * La función `getColorByDim` toma un valor de dimensión y una matriz de escala de color, y devuelve el
 * color correspondiente de la escala según el valor de la dimensión.
 * @param dim - El parámetro "tenue" representa un valor numérico que se utiliza para determinar el
 * color según una escala de colores.
 * @param colorScale - El parámetro `colorScale` es una matriz de colores. Se utiliza para determinar
 * el color en función del valor del parámetro "dim". La matriz debe contener al menos 8 colores, donde
 * el primer color se usa cuando "dim" es menor o igual a 10, y
 * @returns un color de la matriz `colorScale` basado en el valor del parámetro `dim`.
 */
function getColorByDim(dim, colorScale) {
  return dim > 1000
    ? colorScale[7]
    : dim > 500
    ? colorScale[6]
    : dim > 200
    ? colorScale[5]
    : dim > 100
    ? colorScale[4]
    : dim > 50
    ? colorScale[3]
    : dim > 20
    ? colorScale[2]
    : dim > 10
    ? colorScale[1]
    : colorScale[0];
}

/**
 * La función "returnStyle" devuelve un objeto con propiedades para aplicar estilo al color, la
 * opacidad, el color del borde y la opacidad de relleno de una característica del mapa.
 * @param colorScale - El parámetro colorScale es una variable que representa una escala de colores. Se
 * utiliza para determinar el color de relleno de una forma u objeto.
 * @returns un objeto con las siguientes propiedades: fillColor, opacity, color y fillOpacity.
 */
function returnStyle(colorScale) {
  return {
    fillColor: colorScale,
    opacity: 1,
    color: "black",
    fillOpacity: 0.7,
  };
}

/**
 * La función "handleOnEachFeature" se utiliza para manejar cada característica en una capa y mostrar
 * su información.
 * @param feature - El parámetro de característica representa la característica geográfica que se está
 * procesando. Contiene información sobre la característica específica, como su geometría y
 * propiedades.
 * @param layer - El parámetro de capa es el objeto de capa Folleto que representa la característica en
 * el mapa. Se utiliza para agregar la característica al mapa y aplicarle cualquier estilo o
 * interacción.
 */
function handleOnEachFeature(feature, layer) {
  popupInfo(feature, layer); // Mostrar la información de las AGEBS
  // ...
}

/**
 * La función overlaysIsEmpty comprueba si el objeto superpuesto está vacío.
 * @returns un valor booleano que indica si el objeto "superposiciones" está vacío o no.
 */
function overlaysIsEmpty() {
  // Función para verificar si el objeto overlays está vacío
  return Object.keys(overlays).length === 0;
}

/**
 * La función `popupInfo` crea una ventana emergente con información sobre una característica cuando se
 * hace clic en ella.
 * @param feature - El parámetro de característica representa la característica geográfica en la que se
 * hizo clic. Podría ser un punto, una línea o un polígono en un mapa.
 * @param layer - El parámetro de capa es el objeto de capa al que se adjunta la ventana emergente. Se
 * utiliza para vincular la ventana emergente a la capa y abrirla cuando se hace clic en la capa.
 */
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
          let value = dataLayers[0][key].toLocaleString("en-US");
          // Si la capa está activa
          popupContent += `<li><strong>${LABELED_LIST[key]["label"]}:</strong> ${value} ${LABELED_LIST[key]["unit"]} </li>`; // Añadir el dato a la lista
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

/**
 * La función `getActiveLayersAndData` toma una serie de características y un objeto de
 * superposiciones, y devuelve un objeto que contiene las capas activas y sus datos correspondientes.
 * @param features - Una matriz de características, donde cada característica representa una entidad
 * geográfica con propiedades.
 * @param overlays - El parámetro `overlays` es un objeto que representa las diferentes capas del mapa.
 * Cada clave del objeto representa el nombre de una capa y el valor correspondiente es la capa misma.
 * @returns un objeto con dos propiedades: "activeLayers" y "dataLayers". La propiedad "activeLayers"
 * es un objeto que contiene las capas activas en el mapa, con la capa "claveAGEB" siempre establecida
 * en verdadero. La propiedad "dataLayers" es una matriz de objetos, donde cada objeto representa los
 * datos de una característica en la matriz "features".
 */
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

/**
 * La función `buildTable` toma dos parámetros, `activeLayers` y `dataLayers`, y devuelve una tabla
 * HTML formateada basada en los datos proporcionados.
 * @param activeLayers - Un objeto que representa las capas activas. Las claves son los nombres de las
 * capas y los valores son valores booleanos que indican si la capa está activa o no.
 * @param dataLayers - El parámetro `dataLayers` es un objeto que contiene los datos de cada capa. Cada
 * clave del objeto representa una capa, y el valor correspondiente es un objeto que contiene los datos
 * de cada AGEB (Área Geoestadística Básica). La estructura del objeto `dataLayers`
 * @returns una cadena que representa una tabla HTML.
 */
function buildTable(activeLayers, dataLayers) {
  let table =
    "<hr> <h1>Reporte / AGEBS</h1> <table width='100%' border='1' style='text-align: center;'>"; // Inicio de la tabla
  table += `<tr>`; // Inicio de la fila

  // Iterar sobre las capas activas y añadir encabezados
  for (const agebLayer in activeLayers) {
    if (activeLayers.hasOwnProperty(agebLayer) && activeLayers[agebLayer]) {
      if (LABELED_LIST[agebLayer]["unit"] === "") {
        table += `<th>${LABELED_LIST[agebLayer]["label"]}</th>`; // Añadir encabezado para la capa
      } else {
        table += `<th>${LABELED_LIST[agebLayer]["label"]} / ${LABELED_LIST[agebLayer]["unit"]}</th>`; // Añadir encabezado para la capa
      }
    }
  }

  table += "</tr>"; // Fin de la fila

  // Iterar sobre los elementos de dataLayers
  for (const agebLayer in dataLayers) {
    if (dataLayers.hasOwnProperty(agebLayer) && dataLayers[agebLayer]) {
      const AGEB = dataLayers[agebLayer];
      table += "<tr>";

      // Iterar sobre las capas activas y añadir datos formateados
      for (const activeLayer in activeLayers) {
        if (
          activeLayers.hasOwnProperty(activeLayer) &&
          activeLayers[activeLayer]
        ) {
          const value = AGEB[activeLayer]
            ? AGEB[activeLayer].toLocaleString("en-US")
            : "N/A";

          table += `<td>${value} ${LABELED_LIST[activeLayer]["unit"]} </td>`;
        }
      }

      table += "</tr>";
    }
  }

  table += "</table>";

  return table;
}

/**
 * La función toggleDropdown alterna la visualización de un menú desplegable y oculta otros menús si
 * están abiertos.
 */
function toggleDropdown() {
  var dropdown = document.getElementById("dropdown");
  var dropdownMapas = document.getElementById("dropdownSubMapas");

  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
  ocultarOtrosMenus(dropdown);

  // Ocultar otros menús si están abiertos
  dropdownMapas.style.display = "none";
}

/**
 * La función alterna la visualización de un menú desplegable.
 */
function toggleDropdownMapas() {
  var dropdownMapas = document.getElementById("dropdownSubMapas");

  dropdownMapas.style.display =
    dropdownMapas.style.display === "block" ? "none" : "block";
  ocultarOtrosMenus(dropdownMapas);
}

/**
 * La función toggleDropdownMedicion alterna la visualización de un menú desplegable y oculta otros
 * menús.
 */
function toggleDropdownMedicion() {
  var dropdownMedicion = document.getElementById("dropdownMedicion");
  var dropdownMapas = document.getElementById("dropdownSubMapas");

  dropdownMedicion.style.display =
    dropdownMedicion.style.display === "block" ? "none" : "block";
  dropdownMapas.style.display = "none"; // Oculta el menú de mapas
  ocultarOtrosMenus(dropdownMedicion);
}

/**
 * La función toggleDropdown1 alterna la visualización de un elemento con el ID "dropdown1" entre
 * "bloque" y "ninguno".
 */
function toggleDropdown1() {
  var dropdown1 = document.getElementById("dropdown1");
  dropdown1.style.display =
    dropdown1.style.display === "block" ? "none" : "block";
}

/**
 * La función toggleDropdown2 alterna la visualización de un elemento con el ID "dropdown2" entre
 * "bloque" y "ninguno".
 */
function toggleDropdown2() {
  var dropdown2 = document.getElementById("dropdown2");
  dropdown2.style.display =
    dropdown2.style.display === "block" ? "none" : "block";
}

/**
 * La función toggleDropdown3 alterna la visualización de un elemento con el ID "dropdown3" entre
 * "bloque" y "ninguno".
 */
function toggleDropdown3() {
  var dropdown3 = document.getElementById("dropdown3");
  dropdown3.style.display =
    dropdown3.style.display === "block" ? "none" : "block";
}

/**
 * La función "ocultarOtrosMenus" oculta todos los menús excepto el especificado como parámetro
 * "menuActual".
 * @param menuActual - El parámetro "menuActual" es el menú actualmente activo o seleccionado.
 */
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

/**
 * La función "ocultarMenu" oculta múltiples menús desplegables en una página web.
 */
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

/* El código anterior agrega un detector de eventos al evento "DOMContentLoaded". Cuando el contenido
DOM haya terminado de cargarse, se llamará a la función "ocultarMenu". */
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

/**
 * La función "cambiarMapa" cambia la capa del mapa base en un mapa de Folleto según el tipo de
 * entrada.
 * @param tipo - El parámetro "tipo" es una cadena que representa el tipo de mapa al que se cambiará.
 * Puede tener uno de los siguientes valores: "WorldImagery", "WorldStreetMap" o "TopoMap".
 */
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
