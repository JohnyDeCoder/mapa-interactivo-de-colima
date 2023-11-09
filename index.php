<?php
// Cargamos la configuración de Eloquent ORM
require __DIR__ . '/start.php';

// $agebs = Poblaciones::get_all_onlyAGEB_POBTOT();

// $ruta = __DIR__ . '/agebs_template.json';

// $json = file_get_contents($ruta);
// // Convertir la cadena JSON a un objeto PHP
// $obj = json_decode($json);

// // Acceder al primer elemento del arreglo features
// $feature = $obj->features[0];

// // Recorrer el arreglo features del objeto PHP
// foreach ($obj->features as $feature) {
//   if ($feature->properties->name != "Municipio Colima") {
//     // Obtener la clave del AGEB del objeto PHP
//     $ageb = $feature->properties->CVE_AGEB;

//     // Buscar la clave del AGEB en el arreglo asociativo
//     if (isset($agebs[$ageb])) {
//       // Reemplazar el valor de la propiedad POBTOT del objeto PHP con el valor de la población total del arreglo asociativo
//       $feature->properties->POBTOT = $agebs[$ageb];
//     }
//   }

//   // Convertir el objeto PHP modificado a una cadena JSON
//   $json = json_encode($obj);

//   // Guardar la cadena JSON en un nuevo archivo
//   file_put_contents('agebs.json', $json);
// }

//! IMPORTARTE
// Importamos la clase Poblaciones del namespace Controllers
// use Controllers\Poblaciones;

// // Obtener todas las AGEBs con todos los campos
// $agebs = Poblaciones::get_all_onlyAGEB_ALL();

// // Ruta del archivo JSON de la plantilla
// $ruta = __DIR__ . '/agebs_template.json';

// // Obtener el contenido del archivo JSON de la plantilla
// $json = file_get_contents($ruta);

// // Convertir la cadena JSON a un objeto PHP
// $obj = json_decode($json);

// // Acceder al primer elemento del arreglo features
// $feature = $obj->features[0];

// // Recorrer el arreglo features del objeto PHP
// foreach ($obj->features as $feature) {
//   if ($feature->properties->name != "Municipio Colima") {
//     $ageb = $feature->properties->CVE_AGEB;

//     // Si existe la clave del AGEB en el arreglo asociativo
//     if (isset($agebs[$ageb])) {
//       $feature->properties->POBTOT = $agebs[$ageb]['POBTOT'];
//       $feature->properties->POBFEM = $agebs[$ageb]['POBFEM'];
//       $feature->properties->POBMAS = $agebs[$ageb]['POBMAS'];
//       $feature->properties->P_0A2 = $agebs[$ageb]['P_0A2'];
//       $feature->properties->P_0A2_F = $agebs[$ageb]['P_0A2_F'];
//       $feature->properties->P_0A2_M = $agebs[$ageb]['P_0A2_M'];
//       $feature->properties->P_3YMAS = $agebs[$ageb]['P_3YMAS'];
//       $feature->properties->P_3YMAS_F = $agebs[$ageb]['P_3YMAS_F'];
//       $feature->properties->P_3YMAS_M = $agebs[$ageb]['P_3YMAS_M'];
//       $feature->properties->P_5YMAS = $agebs[$ageb]['P_5YMAS'];
//       $feature->properties->P_5YMAS_F = $agebs[$ageb]['P_5YMAS_F'];
//       $feature->properties->P_5YMAS_M = $agebs[$ageb]['P_5YMAS_M'];
//       $feature->properties->P_12YMAS = $agebs[$ageb]['P_12YMAS'];
//       $feature->properties->P_12YMAS_F = $agebs[$ageb]['P_12YMAS_F'];
//       $feature->properties->P_12YMAS_M = $agebs[$ageb]['P_12YMAS_M'];
//       $feature->properties->P_15YMAS = $agebs[$ageb]['P_15YMAS'];
//       $feature->properties->P_15YMAS_F = $agebs[$ageb]['P_15YMAS_F'];
//       $feature->properties->P_15YMAS_M = $agebs[$ageb]['P_15YMAS_M'];
//       $feature->properties->P_18YMAS = $agebs[$ageb]['P_18YMAS'];
//       $feature->properties->P_18YMAS_F = $agebs[$ageb]['P_18YMAS_F'];
//       $feature->properties->P_18YMAS_M = $agebs[$ageb]['P_18YMAS_M'];
//       $feature->properties->P_3A5 = $agebs[$ageb]['P_3A5'];
//       $feature->properties->P_3A5_F = $agebs[$ageb]['P_3A5_F'];
//       $feature->properties->P_3A5_M = $agebs[$ageb]['P_3A5_M'];
//       $feature->properties->P_6A11 = $agebs[$ageb]['P_6A11'];
//       $feature->properties->P_6A11_F = $agebs[$ageb]['P_6A11_F'];
//       $feature->properties->P_6A11_M = $agebs[$ageb]['P_6A11_M'];
//       $feature->properties->P_8A14 = $agebs[$ageb]['P_8A14'];
//       $feature->properties->P_8A14_F = $agebs[$ageb]['P_8A14_F'];
//       $feature->properties->P_8A14_M = $agebs[$ageb]['P_8A14_M'];
//       $feature->properties->P_12A14 = $agebs[$ageb]['P_12A14'];
//       $feature->properties->P_12A14_F = $agebs[$ageb]['P_12A14_F'];
//       $feature->properties->P_12A14_M = $agebs[$ageb]['P_12A14_M'];
//       $feature->properties->P_15A17 = $agebs[$ageb]['P_15A17'];
//       $feature->properties->P_15A17_F = $agebs[$ageb]['P_15A17_F'];
//       $feature->properties->P_15A17_M = $agebs[$ageb]['P_15A17_M'];
//       $feature->properties->P_18A24 = $agebs[$ageb]['P_18A24'];
//       $feature->properties->P_18A24_F = $agebs[$ageb]['P_18A24_F'];
//       $feature->properties->P_18A24_M = $agebs[$ageb]['P_18A24_M'];
//       $feature->properties->P_15A49_F = $agebs[$ageb]['P_15A49_F'];
//       $feature->properties->P_60YMAS = $agebs[$ageb]['P_60YMAS'];
//       $feature->properties->P_60YMAS_F = $agebs[$ageb]['P_60YMAS_F'];
//       $feature->properties->P_60YMAS_M = $agebs[$ageb]['P_60YMAS_M'];
//       $feature->properties->REL_H_M = $agebs[$ageb]['REL_H_M'];
//       $feature->properties->POB0_14 = $agebs[$ageb]['POB0_14'];
//       $feature->properties->POB15_64 = $agebs[$ageb]['POB15_64'];
//       $feature->properties->POB65_MAS = $agebs[$ageb]['POB65_MAS'];
//     }
//   }

//   $json = json_encode($obj);

//   file_put_contents('agebs.json', $json);
// }

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Leaflet CSS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    />
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css"
    />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
    <!-- <link rel="icon" type="image/x-icon" href="/images/favicon.ico" /> -->
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>Mapa Interactivo de Colima</title>
  </head>
  <body>
    <!-- Plugin de buscador -->

    <!-- Cabecera  -->

    <!-- FIN Cabecera  -->

    <!-- CAPAS -->

    <!-- Inicia Educacion -->
    <div
      class="accordion sidebar"
      id="accordionExample"
      style="
        width: 17%;
        border-radius: 3px;
        padding-top: 0%;
        margin-top: 3%;
        margin-right: 1%;
        float: right;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1000;
      "
    >
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseOne"
            aria-expanded="true"
            aria-controls="collapseOne"
          >
            <img
              src="assets/img/educacion.png"
              alt="Educacion"
              style="margin-right: 3%; width: 15%"
            />
            Educación
          </button>
        </h2>
        <div
          id="collapseOne"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Termina Educacion -->

      <!--Inicia Salud-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseHealth"
            aria-expanded="true"
            aria-controls="collapseHealth"
          >
            <img
              src="assets/img/salud.png"
              alt="Salud"
              style="margin-right: 3%; width: 15%"
            />
            Salud
          </button>
        </h2>
        <div
          id="collapseHealth"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Termina Salud-->

      <!--Inicia Trabajo-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseWork"
            aria-expanded="true"
            aria-controls="collapseWork"
          >
            <img
              src="assets/img/trabajo.png"
              alt="Trabajo"
              style="margin-right: 3%; width: 15%"
            />
            Trabajo
          </button>
        </h2>
        <div
          id="collapseWork"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Trabajo-->

      <!--Inicia Población-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsePoblation"
            aria-expanded="true"
            aria-controls="collapsePoblation"
          >
            <img
              src="assets/img/poblacion.png"
              alt="Población"
              style="margin-right: 3%; width: 15%"
            />
            Población
          </button>
        </h2>
        <div
          id="collapsePoblation"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Población-->

      <!--Inicia Economía-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseEconomy"
            aria-expanded="true"
            aria-controls="collapseEconomy"
          >
            <img
              src="assets/img/economia.png"
              alt="Economía"
              style="margin-right: 3%; width: 15%"
            />
            Economía
          </button>
        </h2>
        <div
          id="collapseEconomy"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Economía-->

      <!--Inicia Seguridad-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseSecurity"
            aria-expanded="true"
            aria-controls="collapseSecurity"
          >
            <img
              src="assets/img/seguridad.png"
              alt="Seguridad"
              style="margin-right: 3%; width: 15%"
            />
            Seguridad
          </button>
        </h2>
        <div
          id="collapseSecurity"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Seguridad-->

      <!--Inicia Gobierno-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseGovernment"
            aria-expanded="true"
            aria-controls="collapseGovernment"
          >
            <img
              src="assets/img/gobierno.png"
              alt="Gobierno"
              style="margin-right: 3%; width: 15%"
            />
            Gobierno
          </button>
        </h2>
        <div
          id="collapseGovernment"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Gobierno-->

      <!--Inicia Vivienda-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseLivingPlace"
            aria-expanded="true"
            aria-controls="collapseLivingPlace"
          >
            <img
              src="assets/img/vivienda.png"
              alt="vivienda"
              style="margin-right: 3%; width: 15%"
            />
            Vivienda
          </button>
        </h2>
        <div
          id="collapseLivingPlace"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Vivienda-->

      <!--Inicia Calidad de vida-->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button
            class="accordion-button collapsed"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapseQOL"
            aria-expanded="true"
            aria-controls="collapseQOL"
          >
            <img
              src="assets/img/calidad de vida.png"
              alt="Calidad de vida"
              style="margin-right: 3%; width: 15%"
            />
            Calidad de vida
          </button>
        </h2>
        <div
          id="collapseQOL"
          class="accordion-collapse collapse"
          aria-labelledby="headingOne"
          data-bs-parent="#accordionExample"
          style="max-height: 330px; overflow-y: auto"
        >
          <div class="accordion-body">
            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div
                class="containerS"
                style="max-width: 300px; overflow-x: auto"
              >
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en la enseñanza primaria (6 a 11
                  años de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en educación preescolar (3 a 5 años
                  de edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Tasa neta de matriculación en secundaria (12 a 14 años de
                  edad)
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población femenina analfabeta de 15 a 24 años
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>

            <div class="d-flex justify-content-center">
              <div class="conntainerCB">
                <div
                  class="div-con-checkbox-y-slider"
                  style="display: flex; flex-flow: row wrap"
                ></div>
                <input
                  type="checkbox"
                  id="checkbox"
                  style="margin-right: 20px"
                />
              </div>

              <div class="containerS" style="width: 300px">
                <label
                  for="checkbox"
                  class="label-text"
                  style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  "
                >
                  Población de 15 años o más analfabeta
                </label>
                <input
                  type="range"
                  min="0"
                  max="100"
                  step="10"
                  id="slider"
                  style="width: 100%"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Termina Calidad de vida-->
    </div>
    <!--FIN CAPAS-->

    <!-- Crea un contenedor div para el mapa -->
    <div id="map" style="width: 1530px; height: 750px"></div>
    <!-- Agrega el script para cargar y mostrar los polígonos -->
    <script src="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
    <!-- Bootstrap JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    ></script>
    <script src="assets/js/mapa.js"></script>
  </body>
</html>
