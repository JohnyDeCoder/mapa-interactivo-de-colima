<?php
// Cargamos la configuración de Eloquent ORM
require __DIR__ . 'start.php';

// use Controllers\Users; // Importamos el controlador Users
// $user = Users::create_user("Lola"); // Creamos un usuario
// echo $user->name; // Imprimimos el nombre del usuario
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico" />
  <link rel="stylesheet" href="./assets/css/style.css" />
  <title>Mapa Interactivo de Colima</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

  <!--CAPAS-->
  <!-- Inicia Educacion -->
  <div class="accordion" id="accordionExample" style="
        width: 17%;
        border-radius: 3px;
        padding-top: 3%;
        margin-right: 1%;
        float: right;
        position: absolute;
        top: 0;
        right: 0;
        z-index: 1000;
      ">
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <img src="./assets/img/educacion.png" alt="Educacion" style="margin-right: 3%; width: 15%" />
          Educación
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Termina Educacion -->

    <!--Inicia Salud-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHealth" aria-expanded="true" aria-controls="collapseHealth">
          <img src="./assets/img/salud.png" alt="Salud" style="margin-right: 3%; width: 15%" />
          Salud
        </button>
      </h2>
      <div id="collapseHealth" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Termina Salud-->

    <!--Inicia Trabajo-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWork" aria-expanded="true" aria-controls="collapseWork">
          <img src="./assets/img/trabajo.png" alt="Trabajo" style="margin-right: 3%; width: 15%" />
          Trabajo
        </button>
      </h2>
      <div id="collapseWork" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Termina Trabajo-->

    <!--Inicia Población-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePoblation" aria-expanded="true" aria-controls="collapsePoblation">
          <img src="./assets/img/poblacion.png" alt="Población" style="margin-right: 3%; width: 15%" />
          Población
        </button>
      </h2>
      <div id="collapsePoblation" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Termina Población-->

    <!--Inicia Economía-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEconomy" aria-expanded="true" aria-controls="collapseEconomy">
          <img src="./assets/img/economia.png" alt="Economía" style="margin-right: 3%; width: 15%" />
          Economía
        </button>
      </h2>
      <div id="collapseEconomy" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Termina Economía-->

    <!--Inicia Seguridad-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecurity" aria-expanded="true" aria-controls="collapseSecurity">
          <img src="./assets/img/seguridad.png" alt="Seguridad" style="margin-right: 3%; width: 15%" />
          Seguridad
        </button>
      </h2>
      <div id="collapseSecurity" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Termina Seguridad-->

    <!--Inicia Gobierno-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGovernment" aria-expanded="true" aria-controls="collapseGovernment">
          <img src="./assets/img/gobierno.png" alt="Gobierno" style="margin-right: 3%; width: 15%" />
          Gobierno
        </button>
      </h2>
      <div id="collapseGovernment" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Termina Gobierno-->

    <!--Inicia Vivienda-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLivingPlace" aria-expanded="true" aria-controls="collapseLivingPlace">
          <img src="./assets/img/vivienda.png" alt="vivienda" style="margin-right: 3%; width: 15%" />
          Vivienda
        </button>
      </h2>
      <div id="collapseLivingPlace" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Termina Vivienda-->

    <!--Inicia Calidad de vida-->
    <div class="accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseQOL" aria-expanded="true" aria-controls="collapseQOL">
          <img src="./assets/img/calidad de vida.png" alt="Calidad de vida" style="margin-right: 3%; width: 15%" />
          Calidad de vida
        </button>
      </h2>
      <div id="collapseQOL" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="max-height: 330px; overflow-y: auto">
        <div class="accordion-body">
          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="max-width: 300px; overflow-x: auto">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en la enseñanza primaria (6 a 11
                años de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en educación preescolar (3 a 5 años
                de edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Tasa neta de matriculación en secundaria (12 a 14 años de
                edad)
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población femenina analfabeta de 15 a 24 años
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
            </div>
          </div>

          <div class="d-flex justify-content-center">
            <div class="conntainerCB">
              <div class="div-con-checkbox-y-slider" style="display: flex; flex-flow: row wrap"></div>
              <input type="checkbox" id="checkbox" style="margin-right: 20px" />
            </div>

            <div class="containerS" style="width: 300px">
              <label for="checkbox" class="label-text" style="
                    word-wrap: break-word;
                    white-space: normal;
                    margin: 5px 0;
                  ">
                Población de 15 años o más analfabeta
              </label>
              <input type="range" min="0" max="100" step="10" id="slider" style="width: 100%" />
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

  <div>
    <button id="toggleMancha1">Mancha 1</button>
    <button id="toggleMancha2">Mancha 2</button>
    <button id="toggleMancha3">Mancha 3</button>
    <button id="toggleMunicipio">Municipio</button>
  </div>

  <!-- Agrega el script para cargar y mostrar los polígonos -->
  <script src="//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js"></script>
  <script src="./assets/js/mapa.js"></script>
</body>

</html>