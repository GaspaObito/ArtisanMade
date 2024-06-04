<?php
require 'config/config.php';
require 'config/database.php';
$sql = $con->prepare("SELECT latitud,longitud,direccion,nombre,descripcion FROM marcadores");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
// Crear un array para almacenar los datos
$marcadores = array();
// Procesar los resultados de la consulta y almacenarlos en el array
if (count($resultado) > 0) {
    foreach ($resultado as $row) {
      $marcadores[] = array(
        'latitud' => $row['latitud'],
        'longitud' => $row['longitud'],
        'direccion' => $row['direccion'],
        'nombre' => $row['nombre'],
        'descripcion' => $row['descripcion']
      );
    }
}
$con = null; 
?>
<!DOCTYPE html>
<html lang="en">
<!-- INICIO Head -->
<?php include 'template/head.php'; ?>
<!-- FIN Head -->
<body>
  <!-- INICIO Header -->
  <?php include 'template/header.php'; ?>
  <!-- FIN Header -->
  <!-- INICIO Contenido -->
     <!--==================== NUESTRA HISTORIA ====================-->
     <section class="story section container" id="nosotros">
            <div class="story__container grid">
                <div class="story__data">
                    <h2 class="section__title story__section-title">
                        Nuestra Historia
                    </h2>

                    <h1 class="story__title">
                        Artesanías Inspiradoras de <br> este año
                    </h1>

                    <p class="story__description">
                        Las últimas y más inspiradoras artesanías de este año están disponibles en 
                        nuestra tienda, hechas con amor y cuidado por artesanos locales.
                    </p>

                    <a href="#" class="button button--small">Descubrir</a>
                </div>

                <div class="story__images">
                    <img src="assets/img/img5.png" alt="" class="story__img">
                    <div class="story__square"></div>
                </div>
            </div>
        </section>
  <!--==================== Leafjet ====================-->
  <section class="section container">
  <div class="row justify-content-center mb-4">
        <div class="col-lg-6 text-center">
          <p class="fs-6 m-0">Tiendas de Artesanias</p>
          <h2 class="mt-2 mb-0">Localidad Mapa</h2>
        </div>
      </div>
  <div id="mi_mapa" style="width: 100%; height: 750px;"></div>
  </section>
  <!-- FIN Contenido -->
<!-- INICIO Footer -->
<?php include 'template/footer.php'; ?>
<!-- FIN Footer -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
<!-- INICIO SCRIPT -->
<script>
// ====== OSM  LAYER ======
  var map = L.map('mi_mapa').setView([4.65640, -74.1331], 12);
  var lc = L.control.locate().addTo(map); //Boton de Ubicacion
  var marcadores = []; // Array para almacenar los marcadores
  var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
osm.addTo(map);
// ====== MARKERS ======
  // Iterar sobre el array de marcadores y agregar círculos al mapa
<?php foreach($marcadores as $marcador): ?>
  var lat = <?php echo $marcador['latitud']; ?>;
  var lng = <?php echo $marcador['longitud']; ?>;
  var direccion = "<?php echo $marcador['direccion']; ?>";
  var nombre = "<?php echo $marcador['nombre']; ?>";
  var descripcion = "<?php echo $marcador['descripcion']; ?>";
  var popupContent = "<b>" + nombre + "</b><br>" + descripcion+ "<br>" + "<br>" + direccion + "";
  // Crear círculo alrededor de la ubicación con radio de 100 metros
  var nuevoMarcador = L.circle([lat, lng], {
            color: 'red', fillColor: '#f03', fillOpacity: 0.5, radius: 100
        }).bindPopup(popupContent);
  marcadores.push(nuevoMarcador); // Agregar marcador al array
<?php endforeach; ?>
    // Crear un grupo de capas para los marcadores
    var grupoMarcadores = L.layerGroup(marcadores).addTo(map); // Agregar los marcadores al mapa desde el inicio

// ====== TILE LAYER ======
var CartoDB_DarkMatter = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
subdomains: 'abcd',
	maxZoom: 19
});
CartoDB_DarkMatter.addTo(map);

// Google Map Layer
googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
 });
 googleStreets.addTo(map);

 // Satelite Layer
googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
   maxZoom: 20,
   subdomains:['mt0','mt1','mt2','mt3']
 });
googleSat.addTo(map);

var Stamen_Watercolor = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/watercolor/{z}/{x}/{y}.{ext}', {
 attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
subdomains: 'abcd',
minZoom: 1,
maxZoom: 16,
ext: 'jpg'
});
Stamen_Watercolor.addTo(map);
// ====== LAYER CONTROL ======
var baseLayers = {
    "Satellite":googleSat,
    "Google Map":googleStreets,
    "Water Color":Stamen_Watercolor,
    "OpenStreetMap": osm,
};
var overlays = {
    "Marcadores": grupoMarcadores,
};
L.control.layers(baseLayers, overlays).addTo(map);
// ====== SEARCH BUTTON ======
L.Control.geocoder().addTo(map);

// ====== ROUTER MACHINE ======
let routingControl = null; // Variable para realizar un seguimiento del estado del control de rutas
// Función para crear el control de rutas
function createRoutingControl(map) {
  routingControl = L.Routing.control({
    waypoints: [
      L.latLng(4.57692, -74.22408), // Punto de inicio
      L.latLng(4.580, -74.216) // Punto de destino
    ],
    routeWhileDragging: true // Permitir actualizar la ruta mientras se arrastra el marcador
  }).addTo(map);
}
// Crear el control de rutas al cargar la página
createRoutingControl(map);
// Función para abrir o cerrar el control de rutas
function toggleRoutingControl() {
  if (routingControl) {
    map.removeControl(routingControl);
    routingControl = null;
  } else {
    createRoutingControl(map);
  }
}
// Agregar el botón de abrir/cerrar
const toggleButton = L.Control.extend({
  options: {
    position: 'topright'
  },
  onAdd: function(map) {
    const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
    container.innerHTML = '<button onclick="toggleRoutingControl()">Abrir/Cerrar Rutas</button>';
    return container;
  }
});
map.addControl(new toggleButton());
</script>
<!-- FIN SCRIPT -->
</body>
</html>