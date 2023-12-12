import { LABELED_LIST } from "./constants.js";

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
export function buildTable(activeLayers, dataLayers) {
  let table = "<h1>Reporte / AGEBS</h1> <table>"; // Inicio de la tabla
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
