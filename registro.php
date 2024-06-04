<?php
require 'config/config.php';
require 'config/database.php';
require 'clases/clienteFunciones.php';
$errors = [];

if (!empty($_POST)) {
  $nombres = trim($_POST['nombres']);
  $apellidos = trim($_POST['apellidos']);
  $email = trim($_POST['email']);
  $telefono = trim($_POST['telefono']);
  $dni = trim($_POST['dni']);
  $usuario = trim($_POST['usuario']);
  $password = trim($_POST['password']);
  $repassword = trim($_POST['repassword']);

  if (esNulo([$nombres, $apellidos, $email, $telefono, $dni, $usuario, $password, $repassword])) {
    $errors[] = "Debe llenar todos los campos";
  }
  if (!esEmail($email)) {
    $errors[] = "La direccion de correo no es valida";
  }
  if (!validaPassword($password, $repassword)) {
    $errors[] = "Las contraseñas no coinciden";
  }
  if (usuarioExiste($usuario, $con)) {
    $errors[] = "El nombre de usuario $usuario ya existe";
  }
  if (emailExiste($email, $con)) {
    $errors[] = "El correo electronico $email ya existe";
  }

  if (count($errors) == 0) {
    $id = registraCliente([$nombres, $apellidos, $email, $telefono, $dni], $con);

    if ($id > 0) {
      $pass_hash = password_hash($password, PASSWORD_DEFAULT);
      $token = generarToken();
      if (!registraUsuario([$usuario, $pass_hash, $token, $id], $con)) {
        $errors[] = "Error al registrar usuario";
      }
    } else {
      $errors[] = "Error al registrar cliente";
    }
  }
}

/*session_destroy(); */
?>
<!DOCTYPE html>
<html lang="es">
<!-- INICIO head -->
<?php include 'template/head.php'; ?>
<!-- FIN head -->
<body>
  <!-- INICIO Header -->
  <?php include 'template/header.php'; ?>
  <!-- FIN Header -->
  <!--Contenido-->
  <section class="section">
    <div class="container wrap-register p-5 backcard-color">
      <h2>Datos del cliente</h2>
      <?php mostrarMensajes($errors); ?>
      <form class="row g-3" action="registro.php" method="post" autocomplete="off">
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="nom"><span class="text-danger">*</span> Nombres</label>
            <div class="group-input">
              <input class="input100" type="text" name="nombres" id="nom" placeholder="Ingrese su Nombre" requireda>
              <span class="focus-input100"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="ape"><span class="text-danger">*</span> Apellidos</label>
            <div class="group-input">
              <input class="input100" type="text" name="apellidos" id="ape" placeholder="Ingrese su Apellido"requireda>
              <span class="focus-input100"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="ema"><span class="text-danger">*</span> Correo electronico</label>
            <div class="group-input">
              <input class="input100" type="text" name="email" id="ema" placeholder="Ingrese su Email"requireda>
              <span class="focus-input100"></span>
              <span id="validaEmail" class="text-danger"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="tel"><span class="text-danger">*</span> Telefono</label>
            <div class="group-input">
              <input class="input100" type="tel" name="telefono" id="tel" placeholder="Ingrese su Telefono"requireda>
              <span class="focus-input100"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="numdoc"><span class="text-danger">*</span> Documento de identificacion</label>
            <div class="group-input">
              <input class="input100" type="text" name="dni" id="numdoc" placeholder="Ingrese su Documento"requireda>
              <span class="focus-input100"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="nomuser"><span class="text-danger">*</span> Nombre de Usuario</label>
            <div class="group-input">
              <input class="input100" type="text" name="usuario" id="nomuser" placeholder="Ingrese su Usuario"requireda>
              <span class="focus-input100"></span>
              <span id="validaUsuario" class="text-danger"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="pass"><span class="text-danger">*</span> Contraseña</label>
            <div class="group-input">
              <input class="input100" type="password" name="password" id="pass" placeholder="Ingrese su Contraseña"requireda>
              <span class="focus-input100"></span>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="wrap-input100 validate-input mb-4">
            <label for="repass"><span class="text-danger">*</span> Repetir contraseña</label>
            <div class="group-input">
              <input class="input100" type="password" name="repassword" id="repass" placeholder="Ingrese su Contraseña"requireda>
              <span class="focus-input100"></span>
            </div>
          </div>
        </div>
        <i><b>Nota:</b> Los campos con asterisco son obligatorios</i>
        <div class="wrap-login100-form-btn">
          <div class="login100-form-bgbtn"></div>
          <button type="submit" class="login100-form-btn">Registar</button>
        </div>
      </form>
    </div>
  </section>
  <!-- INICIO Footer -->
  <?php include 'template/footer.php'; ?>
  <!-- FIN Footer -->
  <!-- INICIO SCRIPT -->
  <script>
    let txtUsuario = document.getElementById('usuario')
    txtUsuario.addEventListener("blur", function () {
      existeUsuario(txtUsuario.value)
    }, false)
    let txtEmail = document.getElementById('email')
    txtEmail.addEventListener("blur", function () {
      existeEmail(txtEmail.value)
    }, false)
    function existeEmail(email) {
      let url = "clases/clienteAjax.php"
      let formData = new FormData()
      formData.append("action", "existeEmail")
      formData.append("email", email)
      fetch(url, {
        method: 'POST',
        body: formData
      }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            document.getElementById('email').value = ''
            document.getElementById('validaEmail').innerHTML = 'Email no disponible'
          } else {

            document.getElementById('validaEmail').innerHTML = ''
          }
        })
    }
    function existeUsuario(usuario) {
      let url = "clases/clienteAjax.php"
      let formData = new FormData()
      formData.append("action", "existeUsuario")
      formData.append("usuario", usuario)
      fetch(url, {
        method: 'POST',
        body: formData
      }).then(response => response.json())
        .then(data => {
          if (data.ok) {
            document.getElementById('usuario').value = ''
            document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
          } else {
            document.getElementById('validaUsuario').innerHTML = ''
          }
        })
    }
  </script>
  <!-- FIN SCRIPT -->
</body>
</html>