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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Libreria de LeaFlet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <!-- Link de archivo CSS -->
     <link rel="stylesheet" href="assets/css/style.css">
     <link rel="stylesheet" href="assets/css/print.css">
     <!-- Libreria geocoder buscador -->
     <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
    <title>Document</title>
</head>
<body>
    
    <div>
        <img class="img-logo" src="assets/img/logo.png" alt="logo-colima">
    </div>
  
    
<!-- Botón circular para capas -->
<button class="circular-button-capas" onclick="toggleDropdown()"></button>

<!-- Menú desplegable con opciones de checkbox para boton de capas-->
 <div id="dropdown" class="dropdown">
  <ul class="options-list">
      
        <br>
        
        <button class="boton-poblacion" id="Poblacion" onclick="toggleDropdown1()">Población</button>
          <!-- Menú desplegable de Opción 2 -->
          <div id="dropdown1" class="dropdown1">
            <ul class="options-list1">
              <li>
                <input
                  type="checkbox"
                  id="idPoblacionTot"
                  onchange="togglePoblacionLayer()"
                />
                <label for="idPoblacionTot">Población Total</label>
              </li>
              <li>
                <input type="checkbox" id="idPoblacionMasc" />
                <label for="idPoblacionMasc">Población Masculina</label>
              </li>
              <li>
                <input type="checkbox" id="idPoblacionFem" />
                <label for="idPoblacionFem">Población Femenina</label>
              </li>
            </ul>
        </div>

            
          <button class="boton-educacion" id="educacion" onclick="toggleDropdown3()">Educación</button>
          <!-- Menú desplegable de Opción 2 -->
          <div id="dropdown3" class="dropdown3">
              <ul class="options-list1">
                  
                  <li>
                      <input type="checkbox" id="option3"> 
                      <label for="option3">Población Total</label>
                  </li>
                  <li>
                      <input type="checkbox" id="option4"> 
                      <label for="option4">Población Masculina</label>
                  </li>
                  <li>
                      <input type="checkbox" id="option5"> 
                      <label for="option5">Población Femenina</label>
                  </li>
              </ul>
          </div>
      

    <li>
        
        <button  class="boton-mapa" type="button" id="mapa" onclick="toggleDropdown2()">Mapa</button>
        
        <!-- Menú desplegable de Opción 2 -->
        <div id="dropdown2" class="dropdown2">
        <ul>
            <li>
                <input type="checkbox" id="mapaAgeb" onchange=""> 
                <label for="mapa" class="ageb-text"> Agebs </label>
            </li>
        </ul>
        </div>
    </li>

  </ul>
</div>


<!-- Botón circular para mapas -->
<button class="circular-button-mapa" onclick="toggleDropdownMapas()"></button>

<!-- Menú desplegable con opciones de checkbox para boton de mapas-->
 <div id="dropdownSubMapas" class="dropdownSubMapas">
  <ul class="options-list">
      
        <div clas="cont-btn-imagery">
             <button class="btn-mapas" onclick="cambiarMapa('WorldImagery')">World Imagery</button>
             <img class="img-imagery" src="assets/img/imagery.png" alt="imagery">
        </div>
        <div clas="cont-btn-world">
             <button class="btn-mapas" onclick="cambiarMapa('WorldStreetMap')">World Street Map</button>
             <img class="img-world" src="assets/img/world.png" alt="world">
        </div>
        <div clas="cont-btn-topo">
             <button class="btn-mapas" onclick="cambiarMapa('TopoMap')">Topo Map</button>
             <img class="img-topo" src="assets/img/topo.png" alt="topo">
        </div>
        
        
  </ul>
</div>


<!-- Botón circular para medicion -->
<button class="circular-button-imprimir" onclick="toggleDropdownMedicion()"></button>


        
  



    







  <div id="map"></div>

    <!-- Libreria de Leaflet Script -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <!-- Libreria de geocoder Script -->
    <script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
    <!-- Libreria para imrpimir -->
    <script src="assets/libs/leaflet.browser.print.min.js"></script>
    <!-- Link de archivo js app -->
    <script src="assets/js/colima.js"></script>
    <script src="assets/js/agebs.js"></script>
    <script src="assets/js/mapa.js"></script>
</body>
</html>