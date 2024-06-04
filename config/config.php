<?php
define("CLIENT_ID", "AfBbZfhnxELifDZU1HmROwmzhMTWwe_j6Kq7PpcbPIaEhXfGUY9wAnM1mT7unS8NpEeB_SHGE-Sf1s2V");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA", "$");
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$num_cart = 0;
if (isset($_SESSION['carrito']['productos'])) {

  $num_cart = count($_SESSION['carrito']['productos']);
}
// Función para cerrar sesión
function CerrarSesion() {
    session_unset();
    session_destroy();
}
// Verificar si se ha enviado el formulario de cierre de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['logout'])) {
    CerrarSesion();
    header("location: /proyectos/ArtisanMade/index.php"); // Redirigir al usuario a index.php después de cerrar sesión
    exit;
}
?>