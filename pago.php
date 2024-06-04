<?php
require 'config/config.php';
require 'config/database.php';
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();

if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {
    $sql = $con->prepare("SELECT id, nombre, precio, descuento, $cantidad AS cantidad FROM productos where id=? AND activo=1");
    $sql->execute([$clave]);
    $temp_producto = $sql->fetch(PDO::FETCH_ASSOC);
    if ($temp_producto)
      $lista_carrito[] = $temp_producto;
  }
} else {
  header("Location: index.php?");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<!-- INICIO Head -->
<?php include 'template/head.php'; ?>
<!-- FIN Head -->
<body>
  <!-- INICIO Header -->
  <?php include 'template/header.php'; ?>
  <!-- FIN Header -->
  <!--Contenido-->
  <section class="section container">
      <div class="row">
        <div class="col-6">
          <h4>Detalles de pago</h4>
          <div id="paypal-button-container"></div>
        </div>
        <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($lista_carrito == null) {
                  echo '<tr><td colspan ="5" class="text-center"><b>Lista vacia</b></td></tr>';
                } else {

                  $total = 0;
                  foreach ($lista_carrito as $producto) {
                    $_id = $producto['id'];
                    $nombre = $producto['nombre'];
                    $precio = $producto['precio'];
                    $descuento = $producto['descuento'];
                    $cantidad = $producto['cantidad'];
                    $precio_desc = $precio - (($precio * $descuento) / 100);
                    $subtotal = $cantidad * $precio_desc;
                    $total += $subtotal;
                    ?>

                    <tr>
                      <td>
                        <?php echo $nombre; ?>
                      </td>
                      <td>
                        <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                          <?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>
                        </div>
                      </td>
                    </tr>
                  <?php } ?>

                  <tr>
                    <td colspan="2">
                      <p class="h3 text-end" id="total">
                        <?php echo MONEDA . number_format($total, 2, '.', ','); ?>
                      </p>
                    </td>
                  </tr>
                </tbody>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
  </section>
  <!-- INICIO Footer -->
  <?php include 'template/footer.php'; ?>
  <!-- FIN Footer -->
  <!-- INICIO SCRIPT -->
  <script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"></script>
  <script>
    paypal.Buttons({
      style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
      },
      createOrder: function (data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: <?php echo $total; ?>
                        }
                    }]
                });
            },

    onApprove: function(data, actions) {
      let url = 'clases/captura.php'
      actions.order.capture().then(function (detalles) {
        console.log(detalles)

        return fetch(url, {
          method: 'POST',
          headers: {
            'content-type': 'application/json'
          },
          body: JSON.stringify({

            detalles: detalles
          })
        }).then(function (response) {
          window.location.href = "completado.php?key=" + detalles['id'];
        })
      });
    },

    onCancel: function(data) {
      alert("Pago cancelado");
      console.log(data);
    }
        }).render('#paypal-button-container');
  </script>
  <!-- FIN SCRIPT -->
</body>
</html>