<?php include ('includes/header.php');
require '../config/config.php';
require "controlador/crud_operaciones.php";
// Verificar si hay un mensaje de alerta en la sesión
if (isset($_SESSION['alert'])) {
  $alertType = $_SESSION['alert']['type'];
  $alertMessage = $_SESSION['alert']['message'];
  // Eliminar el mensaje de alerta para que no se muestre de nuevo
  unset($_SESSION['alert']);
}
?>
<section class="section container">
  <h2 class="section__title">Productos</h2>
  <div class="container wrap-register p-5 backcard-color">
    <h2 class="section__title story__section-title">Registro del Producto</h2>
    <!-- Mensaje Alert -->
    <?php if (isset($alertType) && isset($alertMessage)): ?>
      <div class="alert alert-<?php echo $alertType; ?> alert-dismissible fade show" role="alert">
        <?php echo $alertMessage; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <!-- Nuevo Producto -->
    <form class="row g-3" method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="nom"><span class="text-danger">*</span> Producto:</label>
          <div class="group-input">
            <input class="input100" type="text" name="nombre" placeholder="Nombre del producto" required>
            <span class="focus-input100"></span>
            <i class='bx bx-rename'></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="ape"><span class="text-danger">*</span> Descripcion:</label>
          <div class="group-input">
            <textarea class="input100 pt-3" type="text" name="descripcion" placeholder="Descripcion del producto"
              required></textarea>
            <span class="focus-input100"></span>
            <i class='bx bx-text'></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="ema"><span class="text-danger">*</span> Precio:</label>
          <div class="group-input">
            <input class="input100" type="number" name="precio" placeholder="Ingrese el Precio" required>
            <span class="focus-input100"></span>
            <i class='bx bx-money-withdraw'></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="tel"><span class="text-danger">*</span> Descuento:</label>
          <div class="group-input">
            <input class="input100" type="number" name="descuento" placeholder="Descuento del producto (%)" min="0"
              max="100">
            <span class="focus-input100"></span>
            <i class='bx bxs-discount'></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="numdoc"><span class="text-danger">*</span> Estado:</label>
          <div class="group-input">
            <select class="input100" id="activo" name="activo"
              style="border: none; outline: none; background: transparent;">
              <option value="1">Activo</option>
              <option value="0">Inactivo</option>
            </select>
            <span class="focus-input100"></span>
            <i class='bx bx-shield'></i>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="pass"><span class="text-danger">*</span> Cargar Imagen Principal:</label>
          <div class="group-input">
            <input class="input100 pt-3" type="file" id="formFile" name="imageSingle" required>
            <span class="focus-input100"></span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="wrap-input100 validate-input mb-4">
          <label for="repass"><span class="text-danger">*</span> Imagenes Adicionales:</label>
          <div class="group-input">
            <input class="input100 pt-3" type="file" id="formFileMultiple" name="imageVarious[]" multiple>
            <span class="focus-input100"></span>
          </div>
        </div>
      </div>
      <i><b>Nota:</b> Los campos con asterisco son obligatorios</i>
      <div class="wrap-login100-form-btn">
        <div class="login100-form-bgbtn"></div>
        <button class="login100-form-btn" name="agregar_producto" value="ok">Agregar Producto</button>
      </div>
    </form>
  </div>
  <br>
  <!-- tabla -->
  <div class="table-responsive pe-0 ">
    <h2 class="section__title mt-4">Productos Agregados</h2>
    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Descuento</th>
          <th>Activo</th>
          <th>fecha Registro</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = $con->query("SELECT * FROM productos");
        foreach ($sql as $datos) { ?>
          <tr>
            <th>
              <?php echo $datos['id']; ?>
            </th>
            <td>
              <?php echo $datos['nombre']; ?>
            </td>
            <td>
              <?php echo $datos['descripcion']; ?>
            </td>
            <td>
              <?php echo $datos['precio']; ?>
            </td>
            <td>
              <?php echo $datos['descuento']; ?>
            </td>
            <td>
              <?php echo $datos['activo']; ?>
            </td>
            <td>
              <?php echo $datos['fecha_registro']; ?>
            </td>
            <td>
              <a href="modificar_producto.php?id=<?php echo $datos['id']; ?>" class="btn btn-small btn-warning mb-2"><i
                  class='bx bx-edit-alt'></i></a>
              <form method="POST">
                <input type="hidden" name="id" value="<?php echo $datos['id']; ?>">
                <button onclick="return eliminar()" type="submit" class="btn btn-danger" name="eliminar_producto"
                  value="ok"><i class='bx bx-trash'></i></button>
              </form>
            </td>
          </tr>
        <?php }
        ?>
      </tbody>
    </table>
  </div>
  </div>
</section>
<script>
  function eliminar() {
    return confirm("¿Estás seguro de que deseas eliminar este producto?");
  }
</script>
<?php include ('includes/footer.php'); ?>