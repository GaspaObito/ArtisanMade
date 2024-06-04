<?php include "../config/database.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Dashboard - SB Admin</title>
    <?php define('BASE_URL', '/proyectos/ArtisanMade/'); ?>
    <link href="<?php echo BASE_URL; ?>/assets/img/Logo_ArtesanMade_Ball.ico" rel="icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/swiper-bundle.min.css">
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/styles.css">
</head>
<body>
    <!-- Header -->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="/proyectos/ArtisanMade/admin/productos.php" class="nav__logo">
                <img class="nav__logo-svg" src="/proyectos/ArtisanMade/assets/img/svg/Logo_ArtesanMade_Ball.svg"
                    alt="Image">
                <i class="nav__logo nav__logo-icon">ARTISAN<span class="text-danger">MADE</span></i>
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="productos.php" class="nav__link"><i class='bx bx-message-alt-add'></i> Productos</a>
                    </li>
                    <li class="nav__item">
                        <a href="tablas.php?tipo=Clientes" class="nav__link"><i class='bx bx-paperclip'></i> Clientes</a>
                    </li>
                    <li class="nav__item">
                        <a href="tablas.php?tipo=Compras" class="nav__link"><i class='bx bx-transfer'></i> Transaccion info</a>
                    </li>
                    <li class="nav__item">
                        <a href="tablas.php?tipo=detalles_Producto" class="nav__link"> <i class='bx bx-info-circle'></i> Detalles de Compra</a>
                    </li>
                    <li style="line-height: 0;">
                    <form method="post" action="../config/config.php">
                    <button type="submit" name="logout"> <a class='bx bx-user-minus change-theme'></a></button>
                    </form> 
                    </li>
                </ul>
                <div class="nav__close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>
            </div>
            <!-- Botón de cambio de tema -->
            <div class="nav__btns">
                <i class="bx bx-moon change-theme" id="theme-button"></i>
                <div class="nav__toggle" id="nav-toggle">
                    <i class="bx bx-grid-alt"></i>
                </div>
            </div>
        </nav>
    </header>