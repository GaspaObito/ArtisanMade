<?php
require '../config/config.php';  
require '../config/database.php';  
require '../clases/clienteFunciones.php';
$errors = [];
if(!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    if(esNulo([$usuario,$password])){
        $errors[]="debe llenar todos los campos";
    }
    if(count($errors)==0){
        $errors[] = loginAdmin($usuario,$password,$con);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<!-- INICIO head -->
<?php include '../template/head.php'; ?>
<!-- FIN head -->
<body>
  <!-- INICIO head -->
  <?php include '../template/header.php'; ?>
  <!-- FIN head -->
  <!-- INICIO Login -->
  <section class="section container-login100">
    <div class="wrap-login100 p-5 backcard-color">
      <?php mostrarMensajes($errors); ?>
      <form class="login100-form validate-form" action="login_admin.php" method="post" autocomplete="off">
        <span class="login100-form-title pb-5">
          Iniciar Sesion Administrador
        </span>
        <div class="wrap-input100 validate-input mb-4" data-validate="Username is required">
          <span class="ps-2">Nombre</span>
          <div class="group-input"><input class="input100" type="text" name="usuario" placeholder="Ingrese su Usuario">
            <span class="focus-input100"></span>
            <i class='bx bx-user' ></i>
          </div>
        </div>
        <div class="wrap-input100 validate-input" data-validate="Password is required">
          <span class="ps-2">Contraseña</span>
          <div class="group-input">
            <input class="input100" type="password" name="password" placeholder="Ingrese su Contraseña">
            <span class="focus-input100"></span>
            <i class='bx bx-lock-alt'></i>
          </div>
        </div>
        <div class="text-end pt-2 pb-5">
          <a href="#">¿Olvido contraseña?</a>
        </div>
        <div class="container-login100-form-btn">
          <div class="wrap-login100-form-btn">
            <div class="login100-form-bgbtn"></div>
            <button class="login100-form-btn">Ingresar</button>
          </div>
        </div>
        <div class="pt-4 pb-5">
          <span>¿No tienes Cuenta?</span>
          <a href="registro.php" class="text-uppercase">Registrar</a>
          <br>
          <span>Cambiar de usuario</span>
            <a href="../login.php">Cliente</a>
        </div>
      </form>
    </div>
  </section>
  <!-- FIN Login -->
  <!-- INICIO Footer -->
  <?php include '../template/footer.php'; ?>
  <!-- FIN Footer -->
</body>
</html>