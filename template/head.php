<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtisanMade</title>
    <!-- Favicon -->
    <?php define('BASE_URL', '/proyectos/ArtisanMade/'); ?>
    <link href="<?php echo BASE_URL; ?>/assets/img/Logo_ArtesanMade_Ball.ico" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- PayPal Checkout -->
    <script src="https://www.paypal.com/sdk/js?client-id=AfBbZfhnxELifDZU1HmROwmzhMTWwe_j6Kq7PpcbPIaEhXfGUY9wAnM1mT7unS8NpEeB_SHGE-Sf1s2V"></script>
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--=============== SWIPER CSS ===============--> 
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/swiper-bundle.min.css">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
    <!-- Leaflet OpenStreetMap -->
    <?php if (strpos($_SERVER['PHP_SELF'], 'nosotros.php') !== false) { ?>
    <!-- Start Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Location Button -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <!-- Search Button -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- Router Machine -->    
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <?php } ?>
</head>
