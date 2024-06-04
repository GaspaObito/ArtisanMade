<?php
require 'config/config.php';
require 'config/database.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == '') {
  echo 'Error al procesar la petición';
  exit;
} else {
  $token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);
  if ($token == $token_tmp) {
    $sql = $con->prepare("SELECT count(id) FROM productos WHERE id=? AND activo=1");
    $sql->execute([$id]);
    if ($sql->fetchColumn() > 0) {
      $sql = $con->prepare("SELECT nombre, descripcion, precio, descuento, imagen_principal FROM productos WHERE id=? AND activo=1 LIMIT 1");
      $sql->execute([$id]);
      $row = $sql->fetch(PDO::FETCH_ASSOC);
      $nombre = $row['nombre'];
      $descripcion = $row['descripcion'];
      $precio = $row['precio'];
      $descuento = $row['descuento'];
      $precio_desc = $precio - (($precio * $descuento) / 100);
      $dir_images = 'assets/img/productos/' . $id . '/';

      if (!file_exists($dir_images)) {
        echo 'Error: Carpeta de imágenes no encontrada';
        exit;
      }
      $imagenes = array();
      $dir = dir($dir_images);
      while (($archivo = $dir->read()) !== false) {
        if ($archivo !== '.' && $archivo !== '..' && is_file($dir_images . $archivo)) {
          $imagenes[] = $dir_images . $archivo;
        }
      }
      $dir->close();
    } else {
      echo 'Error: Producto no encontrado o no activo';
      exit;
    }
  } else {
    echo 'Error: Token no válido';
    exit;
  }
}
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
  <!-- Contenido -->
  <section class="section container">
    <div class="row product-container">
      <div class="col-md-6 order-md-1 align-self-start">
        <div id="carouselImages" class="carousel slide">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="<?php echo $row['imagen_principal']; ?>" class="d-block w-100 product-image" alt="Product Image">
            </div>
            <?php foreach ($imagenes as $img) {
            // Obtener la ruta base de la imagen actual
            $img_base = basename($img);
            $principal_base = basename($row['imagen_principal']);
            // Verificar si la imagen es la misma que la imagen principal
            if ($img_base === $principal_base) {
                continue; // Saltar esta iteración y continuar con la siguiente
            }
            ?>
            <div class="carousel-item">
                <img src="<?php echo $img; ?>" class="d-block w-100 product-image" alt="Product Image">
            </div>
            <?php } ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <div class="d-flex justify-content-between m-2">
          <a href="checkout.php" type="button" class="btn btn-warning p-3"><i class="fas fa-plus"></i> Comprar Ahora</a>
          <button href="login.php" type="button" class="btn btn-success p-3"
            onclick="addProducto(<?php echo $id; ?>, cantidad.value, '<?php echo $token_tmp; ?>')"><i
              class="fas fa-cart-plus"></i> Agregar al carrito</button>
        </div>
      </div>
      <div class="products__card col-md-6 order-md-2 p-4 text-start align-self-start">
        <h2>
          <?php echo $nombre; ?>
        </h2>
        <?php if ($descuento > 0) { ?>
          <p class="lead"><del>
              <?php echo MONEDA . number_format($precio, 2, '.', ','); ?>
            </del></p>
          <h2 class="lead">
            <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
            <small class="text-success">
              <?php echo $descuento; ?>% descuento
            </small>
          </h2>
        <?php } else { ?>
          <h2 class="lead">
            <?php echo MONEDA . number_format($precio, 2, '.', ','); ?>
          </h2>
        <?php } ?>
        <p class="lead">
          <?php echo $descripcion; ?>
        </p>
        <div class="quantity-counter">
          <button id="counter-increment" class="btn btn-success">+</button>
          <input id="cantidad" name="cantidad" class="value" type="number" value="1">
          <button id="counter-decrement" class="btn btn-success">-</button>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- INICIO Footer -->
  <?php include 'template/footer.php'; ?>
  <!-- FIN Footer -->
  <!-- INICIO SCRIPT -->
  <script>
    //button INCREMENT CONFIGURATION
    var counterValue = document.querySelector("#cantidad");
    var counterIncrement = document.querySelector("#counter-increment");
    var counterDecrement = document.querySelector("#counter-decrement");

    counterIncrement.addEventListener('click', () => {
      let currentValue = parseInt(counterValue.value);
      counterValue.value = currentValue + 1;
    });

    counterDecrement.addEventListener('click', () => {
      let currentValue = parseInt(counterValue.value);
      if (currentValue > 0) {
        counterValue.value = currentValue - 1;
      }
    });
    //FUCTION LISTENING ADDPRODUCTO
    function addProducto(id, cantidad, token) {
      let url = 'clases/carrito.php';
      let formData = new FormData();
      formData.append('id', id);
      formData.append('cantidad', cantidad);
      formData.append('token', token);

      fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
      }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            let elemento = document.getElementById("num_cart");
            elemento.innerHTML = data.numero;
            // Restablecer el valor del input a 0
            counterValue.value = 0;
          }
        });
    }
  </script>
  <!-- FIN SCRIPT -->
</body>

</html>