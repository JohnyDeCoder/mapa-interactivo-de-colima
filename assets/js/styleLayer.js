/**
 * La función "returnStyle" devuelve un objeto con propiedades para aplicar estilo al color, la
 * opacidad, el color del borde y la opacidad de relleno de una característica del mapa.
 * @param colorScale - El parámetro colorScale es una variable que representa una escala de colores. Se
 * utiliza para determinar el color de relleno de una forma u objeto.
 * @returns un objeto con las siguientes propiedades: fillColor, opacity, color y fillOpacity.
 */
export function returnStyle(colorScale) {
  return {
    fillColor: colorScale,
    opacity: 1,
    color: "black",
    fillOpacity: 0.7,
  };
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
export function generateColorScale(baseColor, steps) {
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
export function getColorByDim(dim, colorScale) {
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
