import { agebsGeoJson } from "../json/agebs";
import { getColorByDim, generateColorScale, returnStyle } from "./styleLayer";
import { handleOnEachFeature } from "./onEachFeature";

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
