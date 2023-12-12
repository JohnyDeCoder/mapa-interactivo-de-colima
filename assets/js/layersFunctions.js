import { map } from "./main.js";
import { overlays } from "./main.js";

/**
 * La función overlaysIsEmpty comprueba si el objeto superpuesto está vacío.
 * @returns un valor booleano que indica si el objeto "superposiciones" está vacío o no.
 */
export function overlaysIsEmpty() {
  // Función para verificar si el objeto overlays está vacío
  return Object.keys(overlays).length === 0;
}

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
export function initializeLayer(checkboxId, overlayLayer, key) {
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
export function getActiveLayersAndData(features, overlays) {
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
