import { LABELED_LIST } from "./constants.js";
import { overlays } from "./main.js";

import { getActiveLayersAndData } from "./layersFunctions.js";

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
export function handleOnEachFeature(feature, layer) {
  popupInfo(feature, layer); // Mostrar la información de las AGEBS
  // ...
}

//? Functions used in handleOnEachFeature

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
