<?php
require 'config/config.php';
require 'config/database.php';
$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
$lista_carrito = array();
if ($productos != null) {
  foreach ($productos as $clave => $cantidad) {
    $sql = $con->prepare("SELECT id, nombre, precio, descuento,imagen_principal, $cantidad AS cantidad FROM productos where id=? AND activo=1");
    $sql->execute([$clave]);
    $temp_producto = $sql->fetch(PDO::FETCH_ASSOC);
    if ($temp_producto)
      $lista_carrito[] = $temp_producto;
  }
}
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
  <section class="section container">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php if ($lista_carrito == null): ?>
            <tr>
              <td colspan="6" class="text-center"><b>Lista vacía</b></td>
            </tr>
          <?php else: ?>
            <?php
            $total = 0;
            foreach ($lista_carrito as $producto):
              $_id = $producto['id'];
              $imagen = $producto['imagen_principal'];
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
                <img class="products__img" src="<?php echo $imagen; ?>" alt="<?php echo $row['nombre']; ?>">
                </td>
                <td>
                  <?php echo $nombre; ?>
                </td>
                <td>
                  <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
                </td>
                <td>
                  <input type="number" min="1" max="10" step="1" value="<?php echo $cantidad ?>" size="5"
                    id="cantidad_<?php echo $_id; ?>" onchange="actualizarCantidad(this.value, <?php echo $_id; ?>)">
                </td>
                <td>
                  <div id="subtotal_<?php echo $_id; ?>" name="subtotal[]">
                    <?php echo MONEDA . number_format($subtotal, 2, '.', ','); ?>
                  </div>
                </td>
                <td>
                  <a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>"
                    data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td colspan="4"></td>
              <td colspan="2">
                <p class="h3" id="total">
                  <?php echo MONEDA . number_format($total, 2, '.', ','); ?>
                </p>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php if ($lista_carrito != null): ?>
      <div class="row">
        <div class="col-md-5 offset-md-7 d-grid gap-2">
          <?php if (isset($_SESSION['user_cliente'])): ?>
            <button class="btn btn-warning btn-lg" type="button" onclick="eliminarTodos()">Eliminar todos</button>
            <a href="pago.php" class="btn btn-primary btn-lg btn-realizar-pago">Realizar pago</a>
          <?php else: ?>
            <a href="login.php?pago" class="btn btn-primary btn-lg btn-realizar-pago">Realizar pago</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </section>
  <!-- FIN Contenido -->
  <!-- Modal -->
  <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content backcard-color">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Alerta</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Desea eliminar el producto de la lista?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button id="btn-elimina" type="button" class="btn btn-danger" onclick="eliminar()">Eliminar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- INICIO Footer -->
  <?php include 'template/footer.php'; ?>
  <!-- FIN Footer -->
  <script>
    let eliminaModal = document.getElementById('eliminaModal');
    eliminaModal.addEventListener('show.bs.modal', function (event) {

      let button = event.relatedTarget
      let id = button.getAttribute('data-bs-id')
      let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
      buttonElimina.value = id
    })
    function actualizarCantidad(cantidad, id) {
      let url = 'clases/actualizar_carrito.php'
      let formData = new FormData()
      formData.append('action', 'agregar')
      formData.append('id', id)
      formData.append('cantidad', cantidad)

      fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
      }).then(response => response.json())
        .then(data => {
          if (data.ok) {

            let divsubtotal = document.getElementById('subtotal_' + id)
            divsubtotal.innerHTML = data.sub

            let total = 0.00
            let list = document.getElementsByName('subtotal[]')

            for (let i = 0; i < list.length; i++) {
              total += parseFloat(list[i].innerHTML.replace(/[$,]/g, ''));
            }

            total = new Intl.NumberFormat('en-US', {
              minimumFractionDigits: 2
            }).format(total)
            document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
          }
        })
    }
    function eliminar() {
      let botonElimina = document.getElementById('btn-elimina')
      let id = botonElimina.value
      let url = 'clases/actualizar_carrito.php'
      let formData = new FormData()
      formData.append('action', 'eliminar')
      formData.append('id', id)

      fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
      }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            location.reload()
          }
        })
    }
    function eliminarTodos() {
      let url = 'clases/actualizar_carrito.php';
      let formData = new FormData();
      formData.append('action', 'eliminarTodos');

      fetch(url, {
        method: 'POST',
        body: formData,
        mode: 'cors'
      }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            location.reload()
          }
        })
    }
  </script>
</body>
</html>