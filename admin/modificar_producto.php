<?php include ('includes/header.php');
require '../config/config.php';
require "controlador/crud_operaciones.php";  
$id=$_GET["id"];  
$sql=$con->query(" select * from productos where id=$id")
?>
<section class="section">
    <form method="POST" class="col-5 m-auto p-4 backcard-color">
        <h2 class="section__title">Modificar Producto</h2>
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <?php  
    foreach ($sql as $datos) { ?>
        <div class="wrap-input100 validate-input mb-4">
            <span class="ps-2">Producto:</span>
            <div class="group-input">
                <input value="<?php echo $datos['nombre']; ?>" class="input100" type="text" name="nombre"
                    placeholder="Nombre del producto">
                <span class="focus-input100"></span>
                <i class='bx bx-rename'></i>
            </div>
        </div>
        <div class="wrap-input100 validate-input mb-4">
            <span class="ps-2">Descripción:</span>
            <div class="group-input">
                <textarea class="input100 pt-3" id="descripcion" name="descripcion"
                    placeholder="Descripción del producto"><?php echo $datos['descripcion']; ?></textarea>
                <span class="focus-input100"></span>
                <i class='bx bx-text'></i>
            </div>
        </div>
        <div class="wrap-input100 validate-input mb-4">
            <span class="ps-2">Precio:</span>
            <div class="group-input">
                <input value="<?php echo $datos['precio']; ?>" class="input100" type="number" name="precio"
                    placeholder="Precio del producto">
                <span class="focus-input100"></span>
                <i class='bx bx-money-withdraw'></i>
            </div>
        </div>
        <div class="wrap-input100 validate-input mb-4">
            <span class="ps-2">Descuento:</span>
            <div class="group-input">
                <input class="input100" type="number" name="descuento" placeholder="Descuento del producto (%)" min="0" max="100">
                <span class="focus-input100"></span>
                <i class='bx bxs-discount'></i>
            </div>
        </div>
        <div class="wrap-input100 validate-input mb-4">
            <span class="ps-2">Estado:</span>
            <div class="group-input">
                <select class="input100" id="activo" name="activo"
                    style="border: none; outline: none; background: transparent;">
                    <option value="1" <?php echo ($datos['activo']==1) ? 'selected' : '' ; ?>>Activo</option>
                    <option value="0" <?php echo ($datos['activo']==0) ? 'selected' : '' ; ?>>Inactivo</option>
                </select>
                <i class='bx bx-shield'></i>
            </div>
        </div>
        <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button type="submit" class="login100-form-btn" name="btnmodificar" value="ok">Modificar Producto</button>
        </div>
        <?php }?>
    </form>
</section>
<?php include ('includes/footer.php'); ?>