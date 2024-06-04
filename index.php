<?php
require 'config/config.php';
require 'config/database.php';
$sql = $con->prepare("SELECT id, nombre, precio,imagen_principal FROM productos where activo=1");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
/*Agregados Reciente 3*/
$sqlonly3 = $con->prepare("SELECT id, nombre, precio,imagen_principal FROM productos where activo=1 ORDER BY id DESC LIMIT 3;");
$sqlonly3->execute();
$resultonly3 = $sqlonly3->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<!-- INICIO head -->
<?php include 'template/head.php'; ?>
<!-- FIN head -->
<body>
    <!-- INICIO Header -->
    <?php include 'template/header.php'; ?>
    <!-- FIN Header -->
    <!-- Inicio Contenido -->
    <main class="main">
        <!--==================== INICIO ====================-->
        <section class="home" id="home">
            <div class="home__container container grid">
                <div class="home__img-bg">
                    <img src="assets/img/img1.png" alt="" class="home__img">
                </div>
                <div class="home__social">
                    <a href="https://www.facebook.com/" target="_blank" class="home__social-link">
                        Facebook
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="home__social-link">
                        Twitter
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" class="home__social-link">
                        Instagram
                    </a>
                </div>

                <div class="home__data">
                    <h1 class="home__title">NUEVA COLECCIÓN DE ARTESANÍAS</h1>
                    <p class="home__description">
                        Última llegada de las nuevas artesanías, con un diseño único y hecho a mano.
                    </p>

                    <div class="home__btns">
                        <a href="#" class="button button--gray button--small">
                            Descubrir
                        </a>

                    </div>
                </div>
            </div>
        </section>
        <!--==================== LO MAS RECIENTE ====================-->
        <section class="featured section container" id="featured">
            <h2 class="section__title">Producto Nuevos</h2>
            <div class="featured__container grid">
                <?php foreach ($resultonly3 as $row) { 
                $imagen = $row['imagen_principal']; // Obtener la ruta de la imagen principal desde la base de datos
                if (empty($imagen)) {
                    $imagen = "assets/img/no-photo.jpg";
                }
                ?>
                <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>">
                    <article class="featured__card">
                        <span class="featured__tag">Nuevo</span>
                        <img class="products__img" src="<?php echo $imagen; ?>" alt="<?php echo $row['nombre']; ?>">
                        <div class="featured__data">
                            <h3 class="featured__title">
                                <?php echo $row['nombre']; ?>
                            </h3>
                            <span class="featured__price">
                                <?php echo number_format($row['precio'], 2, '.', ','); ?>
                            </span>
                        </div>
                    </article>
                </a>
                <?php } ?>
            </div>
        </section>
        <!--==================== NUESTRA HISTORIA ====================-->
        <section class="story section container">
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

        <!--==================== PRODUCTOS ====================-->
        <section class="products section container" id="products">
            <h2 class="section__title">
                Productos
            </h2>
            <div class="products__container grid">
                <?php foreach ($resultado as $row) { 
                $imagen = $row['imagen_principal']; // Obtener la ruta de la imagen principal desde la base de datos
                if (empty($imagen)) {
                    $imagen = "assets/img/no-photo.jpg";
                }
                ?>
                <a href="details.php?id=<?php echo $row['id']; ?>&token=<?php echo hash_hmac('sha1', $row['id'], KEY_TOKEN); ?>">
                    <article class="products__card">
                        <img class="products__img" src="<?php echo $imagen; ?>" alt="<?php echo $row['nombre']; ?>">
                        <h3 class="products__title">
                            <?php echo $row['nombre']; ?>
                        </h3>
                        <span class="products__price">
                            <?php echo number_format($row['precio'], 2, '.', ','); ?>
                        </span>
                    </article>
                </a>
                <?php } ?>
            </div>
        </section>
        <!--==================== TESTIMONIOS ====================-->
        <section class="testimonial section container">
            <div class="testimonial__container grid">
                <div class="swiper testimonial-swiper">
                    <div class="swiper-wrapper">
                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote">
                                <i class='bx bxs-quote-alt-left'></i>
                            </div>
                            <p class="testimonial__description">
                                Las artesanías que he comprado aquí son increíbles. Cada pieza es única
                                y tienen un gran impacto visual en mi hogar. ¡Definitivamente recomiendo esta tienda!
                            </p>
                            <h3 class="testimonial__date">27 de marzo de 2024</h3>

                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial1.jpg" alt="" class="testimonial__perfil-img">

                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Marío Gómez</span>
                                    <span class="testimonial__perfil-detail">Artista</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial__card swiper-slide">
                            <div class="testimonial__quote">
                                <i class='bx bxs-quote-alt-left'></i>
                            </div>
                            <p class="testimonial__description">
                                La calidad y la atención al detalle en cada artesanía es impresionante.
                                Es evidente el cuidado y la pasión que se pone en cada creación.
                            </p>
                            <h3 class="testimonial__date">15 de abril de 2024</h3>

                            <div class="testimonial__perfil">
                                <img src="assets/img/testimonial2.jpg" alt="" class="testimonial__perfil-img">

                                <div class="testimonial__perfil-data">
                                    <span class="testimonial__perfil-name">Maria Rodríguez</span>
                                    <span class="testimonial__perfil-detail">Coleccionista de Arte</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-button-next">
                        <i class='bx bx-right-arrow-alt'></i>
                    </div>
                    <div class="swiper-button-prev">
                        <i class='bx bx-left-arrow-alt'></i>
                    </div>
                </div>

                <div class="testimonial__images">
                    <div class="testimonial__square"></div>
                    <img src="assets/img/testimonial2.jpg" alt="" class="testimonial__img">
                </div>
            </div>
        </section>

        <!--==================== BOLETÍN INFORMATIVO ====================-->
        <section class="newsletter section container">
            <div class="newsletter__bg grid">
                <div>
                    <h2 class="newsletter__title">Suscríbete a nuestro <br> Boletín Informativo</h2>
                    <p class="newsletter__description">
                        No te pierdas de nuestras ofertas. Suscríbete a nuestro boletín de correo
                        electrónico para obtener las mejores ofertas, descuentos, cupones, regalos y mucho más.
                    </p>
                </div>

                <form action="" class="newsletter__subscribe">
                    <input type="email" placeholder="Ingresa tu correo electrónico" class="newsletter__input">
                    <button class="button">
                        SUSCRIBIRSE
                    </button>
                </form>
            </div>
        </section>
    </main>
    <!-- Fin Contenido -->
    <!-- INICIO Footer -->
    <?php include 'template/footer.php'; ?>
    <!-- FIN Footer -->
    <!-- INICIO SCRIPT -->
    <script>
        function addProducto(id, token) {
            let url = 'clases/carrito.php'
            let formData = new FormData()
            formData.append('id', id)
            formData.append('token', token)

            fetch(url, {
                method: 'POST',
                body: formData,
                mode: 'cors'
            }).then(response => response.json())
                .then(data => {
                    if (data.ok) {
                        let elemento = document.getElementById("num_cart")
                        elemento.innerHTML = data.numero
                    }
                })
        }
    </script>
    <!-- FIN SCRIPT -->
</body>
</html>