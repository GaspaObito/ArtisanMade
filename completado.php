<?php
require 'config/config.php';
require 'config/database.php';
$id_transaccion = isset($_GET['key']) ? $_GET['key'] : '0';
$error = '';
if ($id_transaccion == '') {
  $error = 'Error al procesar la peticion';
} else {
  $sql = $con->prepare("SELECT count(id) FROM compra where id_transaccion=? AND status=?");
  $sql->execute([$id_transaccion, 'COMPLETED']);
  if ($sql->fetchColumn() > 0) {

    $sql = $con->prepare("SELECT id, fecha, email, total FROM compra where id_transaccion=? AND status=? LIMIT 1");
    $sql->execute([$id_transaccion, 'COMPLETED']);
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $idCompra = $row['id'];
    $total = $row['total'];
    $fecha = $row['fecha'];

    $sqlDet = $con->prepare("SELECT nombre ,precio, cantidad from detalle_compra where id_compra = ?");
    $sqlDet->execute([$idCompra]);
  } else {
    $error = 'Error al comprobar la compra';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- INICIO head -->
<?php include 'template/head.php'; ?>
<!-- FIN head -->
<body class="dark-theme">
  <!-- INICIO Header -->
  <?php include 'template/header.php'; ?>
  <!-- FIN Header -->
  <!--INICIO Contenido-->
  <main class="main">
    <div class="container section">
      <?php if (strlen($error) > 0) { ?>
        <div class="row">
          <div class="col">
            <h3>
              <?php echo $error; ?>
            </h3>
          </div>
        </div>
      <?php } else { ?>
        <div class="row">
          <div class="col">
            <b>Folio de la compra: </b>
            <?php echo $id_transaccion; ?><br>
            <b>Fecha de la compra: </b>
            <?php echo $fecha; ?><br>
            <b>Total: </b>
            <?php echo MONEDA . number_format($total, 2, '.', ','); ?><br>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <table class="table">
              <thead>
                <tr>
                  <th>Cantidad</th>
                  <th>Producto</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)) {

                  $importe = $row_det['precio'] * $row_det['cantidad']; ?>

                  <tr>
                    <td>
                      <?php echo $row_det['cantidad']; ?>
                    </td>
                    <td>
                      <?php echo $row_det['nombre']; ?>
                    </td>
                    <td>
                      <?php echo $importe; ?>
                    </td>
                  </tr>
                <?php } ?>

              </tbody>

            </table>
          </div>
        </div>
      <?php } ?>
    </div>
  </main>
  <!--FIN Contenido-->
  <!-- INICIO Footer -->
  <script src="assets/js/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <!-- FIN Footer -->
</body>
</html>