var map = L.map('map', {
  minZoom: 11
}).setView([-103.72714, 19.24997], 11);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

var geocoderControl;


fetch('agebs.json')
  .then(response => response.json())
  .then(data => {
      var polygons = L.geoJSON(data, {
          style: function (feature) {
            var personas = feature.properties.POBTOT;
            var nombre = feature.properties.name;
            
            var fillColor;
            var borderColor = 'transparent'; // Color predeterminado del borde
            var colorCheckbox = document.getElementById('option2'); // Obetenmos el id del checkbox para cambiar el borde

            colorCheckbox.addEventListener('change', function () { // Evento para cambiar el color del borde entre gris y transparente
                // Verificar si el checkbox está marcado
                if (colorCheckbox.checked) {
                    borderColor = ' #6a6a6a ';
                } else {
                    borderColor = 'transparent';
                }

                // Actualizar el estilo de los polígonos
                polygons.setStyle(function (feature) {

                    return {
                        fillColor: 'transparent',
                        color: borderColor,
                        weight: 2,
                        opacity: 1,
                        fillOpacity: 0.9
                    };
                });
            });

            colorCheckbox.checked = false;

            // FIN DE COLOR PARA EL BORDE DEL MUNICIPIO Y AGEBS

            var fillColorPOBTOT;

          // Definir el rango para el color en función de POBTOT
          if (personas >= 0 && personas <= 51) {
              fillColor = '#FF007';  // Color fuerte para números grandes
          } else if (personas > 51 && personas <= 200) {
              fillColor = '#FF66B2';
          } else if (personas >= 201 && personas <= 1000) {
              fillColor = '#FFB2D9';
          } else if (personas >= 1001) {
              fillColor = '#ffdbed';
          } // Color más pálido para números bajos
      
   
          if (nombre === 'Municipio Colima') {
            borderColor = 'transparent';
        }

        
              return {
                 fillColor: fillColor,
                 color: borderColor,
                  weight: 2,
                  opacity: 1,
                  fillOpacity: 0.9
              };
          }
      });


      var geocoderOptions = {
          collapsed: false,
          placeholder: "Buscar ubicación...",
          geocoders: new L.Control.Geocoder.OpenCage('eb23fa5452414e24bd659cfa2888aac7'),
          defaultMarkGeocode: true,
          country: 'mx',
          language: 'es',
      };

      // Añadir límites geográficos para las búsquedas (en este caso, para Colima)
      geocoderOptions.geocoders.options.bounds = L.latLngBounds(
          L.latLng(18.7319, -104.6608), // Esquina suroeste de la región de interés
          L.latLng(20.9085, -103.3948)  // Esquina noreste de la región de interés
      );

      geocoderControl = L.Control.geocoder(geocoderOptions).addTo(map);

      // Agregar un evento para manejar la selección de ubicaciones
      geocoderControl.on('markgeocode', function (event) {
          var location = event.geocode.center;
          
          // Limpiar marcadores anteriores
          map.eachLayer(function (layer) {
              if (layer instanceof L.Marker) {
                  map.removeLayer(layer);
              }
          });

          // Añadir un marcador en la ubicación seleccionada
          L.marker(location).addTo(map);
          
          // Opcional: Ajustar la vista del mapa a la ubicación seleccionada
          map.setView(location, 15);
      });

      polygons.addTo(map);
      map.fitBounds(polygons.getBounds());
  })

  .catch(error => {
      console.error('Error:', error);
  });



  
   // Función para mostrar/ocultar el menú desplegable al hacer clic en el botón
   function toggleDropdown() {
      var dropdown = document.getElementById("dropdown");
      dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
  }
  

  function toggleDropdown1() {
      var dropdown1 = document.getElementById('dropdown1');
      dropdown1.style.display = (dropdown1.style.display === 'block') ? 'none' : 'block';
  }

  function toggleDropdown2() {
      var dropdown2 = document.getElementById('dropdown2');
      dropdown2.style.display = (dropdown2.style.display === 'block') ? 'none' : 'block';
  }


  