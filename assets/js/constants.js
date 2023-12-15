import { agebsGeoJson } from "../json/agebs.js";
import {
  getColorByDim,
  generateColorScale,
  returnStyle,
} from "./styleLayer.js";
import { handleOnEachFeature } from "./onEachFeature.js";

// Lista de nombres de capas de AGEBs
export const LABELED_LIST = {
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
    P_0A2: {
      label: "Población de 0 a 2 años",
      unit: "hab",
    },
    P_0A2_F: {
      label: "Población femenina de 0 a 2 años",
      unit: "hab",
    },
    P_0A2_M: {
      label: "Población masculina de 0 a 2 años",
      unit: "hab",
    },
    P_3YMAS: {
      label: "Población de 3 años y más",
      unit: "hab",
    },
    P_3YMAS_F: {
      label: "Población femenina de 3 años y más",
      unit: "hab",
    },
    P_3YMAS_M: {
      label: "Población masculina de 3 años y más",
      unit: "hab",
    },
    P_5YMAS: {
      label: "Población de 5 años y más",
      unit: "hab",
    },
    P_5YMAS_F: {
      label: "Población femenina de 5 años y más",
      unit: "hab",
    },
    P_5YMAS_M: {
      label: "Población masculina de 5 años y más",
      unit: "hab",
    },
    P_12YMAS: {
      label: "Población de 12 años y más",
      unit: "hab",
    },
    P_12YMAS_F: {
      label: "Población femenina de 12 años y más",
      unit: "hab",
    },
    P_12YMAS_M: {
      label: "Población masculina de 12 años y más",
      unit: "hab",
    },
    P_15YMAS: {
      label: "Población de 15 años y más",
      unit: "hab",
    },
    P_15YMAS_F: {
      label: "Población femenina de 15 años y más",
      unit: "hab",
    },
    P_15YMAS_M: {
      label: "Población masculina de 15 años y más",
      unit: "hab",
    },
    P_18YMAS: {
      label: "Población de 18 años y más",
      unit: "hab",
    },
    P_18YMAS_F: {
      label: "Población femenina de 18 años y más",
      unit: "hab",
    },
    P_18YMAS_M: {
      label: "Población masculina de 18 años y más",
      unit: "hab",
    },
    P_3A5: {
      label: "Población de 3 a 5 años",
      unit: "hab",
    },
    P_3A5_F: {
      label: "Población femenina de 3 a 5 años",
      unit: "hab",
    },
    P_3A5_M: {
      label: "Población masculina de 3 a 5 años",
      unit: "hab",
    },
    P_6A11: {
      label: "Población de 6 a 11 años",
      unit: "hab",
    },
    P_6A11_F: {
      label: "Población femenina de 6 a 11 años",
      unit: "hab",
    },
    P_6A11_M: {
      label: "Población masculina de 6 a 11 años",
      unit: "hab",
    },
    P_8A14: {
      label: "Población de 8 a 14 años",
      unit: "hab",
    },
    P_8A14_F: {
      label: "Población femenina de 8 a 14 años",
      unit: "hab",
    },
    P_8A14_M: {
      label: "Población masculina de 8 a 14 años",
      unit: "hab",
    },
    P_12A14: {
      label: "Población de 12 a 14 años",
      unit: "hab",
    },
    P_12A14_F: {
      label: "Población femenina de 12 a 14 años",
      unit: "hab",
    },
    P_12A14_M: {
      label: "Población masculina de 12 a 14 años",
      unit: "hab",
    },
    P_15A17: {
      label: "Población de 15 a 17 años",
      unit: "hab",
    },
    P_15A17_F: {
      label: "Población femenina de 15 a 17 años",
      unit: "hab",
    },
    P_15A17_M: {
      label: "Población masculina de 15 a 17 años",
      unit: "hab",
    },
    P_18A24: {
      label: "Población de 18 a 24 años",
      unit: "hab",
    },
    P_18A24_F: {
      label: "Población femenina de 18 a 24 años",
      unit: "hab",
    },
    P_18A24_M: {
      label: "Población masculina de 18 a 24 años",
      unit: "hab",
    },
    P_15A49_F: {
      label: "Población femenina de 15 a 49 años",
      unit: "hab",
    },
    P_60YMAS: {
      label: "Población de 60 años y más",
      unit: "hab",
    },
    P_60YMAS_F: {
      label: "Población femenina de 60 años y más",
      unit: "hab",
    },
    P_60YMAS_M: {
      label: "Población masculina de 60 años y más",
      unit: "hab",
    },
    REL_H_M: {
      label: "Relación hombres-mujeres",
      unit: "hab",
    },
    POB0_14: {
      label: "Población de 0 a 14 años",
      unit: "hab",
    },
    POB15_64: {
      label: "Población de 15 a 64 años",
      unit: "hab",
    },
    POB65_MAS: {
      label: "Población de 65 años y más",
      unit: "hab",
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
  };
