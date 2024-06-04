<!--==================== CABECERA ====================-->
<header class="header" id="header">
        <nav class="nav container">
            <a href="<?php echo BASE_URL; ?>index.php" class="nav__logo">
            <img class="nav__logo-svg" src="<?php echo BASE_URL; ?>/assets/img/svg/Logo_ArtesanMade_Ball.svg" alt="Image">
                </svg>
                <i class='nav__logo nav__logo-icon'>ARTISAN<span class="text-danger">MADE</span></i>
            </a>
            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="<?php echo BASE_URL; ?>index.php #home" class="nav__link">Inicio</a>
                    </li>
                    <li class="nav__item">
                        <a href="<?php echo BASE_URL; ?>index.php #featured" class="nav__link">Destacados</a>
                    </li>
                    <li class="nav__item">
                        <a href="<?php echo BASE_URL; ?>index.php #products" class="nav__link">Productos</a>
                    </li>
                    <li class="nav__item">
                    <a href="<?php echo BASE_URL; ?>nosotros.php #nosotros" class="nav__link">Nosotros</a>
                    </li>
                    <li class="nav__item d-flex align-items-center" style="line-height: 0;">
                    <?php if (isset($_SESSION['user_id'])) { ?>
                    <form method="post" action="config/config.php">
                    <button type="submit" name="logout"> <a class='bx bx-user-minus change-theme'></a></button>
                    </form> 
                    <?php } else { ?>
                    <a class='bx bx-user-plus change-theme' href='login.php'></a>
                    <?php } ?>
                    <a class='bx bx-cart-alt change-theme' href="checkout.php"></a> 
                    <a id="num_cart"><?php echo $num_cart; ?></a>   
                    </li>
                </ul>

                <div class="nav__close" id="nav-close">
                    <i class='bx bx-x' ></i>
                </div>
            </div>
            <!-- Botón de cambio de tema -->
            <div class="nav__btns">  
                <i class='bx bx-moon change-theme' id="theme-button"></i>
                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-grid-alt' ></i>
                </div>
            </div>
        </nav>
    </header>
