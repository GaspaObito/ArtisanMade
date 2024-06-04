<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) and isset($_POST["descuento"]) && isset($_POST["activo"])) {
        $id = $_POST["id"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $descuento = $_POST["descuento"];
        $activo = $_POST["activo"];
        // Verificar si $descuento tiene un valor válido
        if (!empty($descuento)) {
            $sql = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, descuento = ?, activo = ? WHERE id = ?");
            $sql->execute([$nombre, $descripcion, $precio, $descuento, $activo, $id]);
        } else {
            // Si $descuento está vacío, asignar NULL en la consulta SQL
            $sql = $con->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, descuento = NULL, activo = ? WHERE id = ?");
            $sql->execute([$nombre, $descripcion, $precio, $activo, $id]);
        }
        if ($sql->rowCount() > 0) {
            $_SESSION['alert'] = ['type' => 'primary', 'message' => 'Producto modificado'];
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error al modificar'];
        }
    } else {
        $_SESSION['alert'] = ['type' => 'warning', 'message' => 'Algunos de los campos esta vacio'];
    }
    header("Location: productos.php");
    exit;
}// Agregar Producto
if (!empty($_POST["agregar_producto"])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["precio"]) && isset($_POST["descuento"])) {
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $descuento = $_POST["descuento"];
        $activo = $_POST["activo"];
        // Insertar el producto en la base de datos
        $sql = $con->prepare("INSERT INTO productos (nombre, descripcion, precio, descuento, activo) VALUES (?, ?, ?, ?, ?)");
        $sql->execute([$nombre, $descripcion, $precio, $descuento, $activo]);
        // Obtener el ID del último producto insertado
        $id_product_last = $con->lastInsertId();
        // Crear la carpeta para almacenar las imágenes del producto
        $ruta_carpeta_raiz = "../assets/img/productos/" . $id_product_last;
        if (!is_dir($ruta_carpeta_raiz)) {
            // Si no existe, intenta crearla
            if (!mkdir($ruta_carpeta_raiz, 0777, true)) {
                // Si hay un error al crear la carpeta, muestra un mensaje de error
                $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Producto no registrado, Durante la creacion de la carpeta para almacenar el producto no fue posible'];
                exit; // Termina la ejecución del script
            }
        }
        // Verificar si se ha seleccionado un archivo para la imagen principal
        if (!empty($_FILES["imageSingle"]["name"])) {
            $nombre_imagen_principal = $_FILES["imageSingle"]["name"];
            $ruta_imagen_principal = $ruta_carpeta_raiz . "/" . $nombre_imagen_principal;
            move_uploaded_file($_FILES["imageSingle"]["tmp_name"], $ruta_imagen_principal);
            $ruta_imagen_principal = "/proyectos/ArtisanMade/assets/img/productos/". $id_product_last."/".$nombre_imagen_principal;
            $sql = $con->prepare("UPDATE productos SET imagen_principal = ? WHERE id = ?");
            $sql->execute([$ruta_imagen_principal, $id_product_last]);
        }
        // Mover archivos adicionales (si los hay)
        if (!empty($_FILES["imageVarious"]["name"])) {
            $imagenes_adicionales = $_FILES["imageVarious"];
            foreach ($imagenes_adicionales["tmp_name"] as $key => $tmp_name) {
                $nombre_imagen_adicional = $imagenes_adicionales["name"][$key];
                $ruta_imagen_adicional = $ruta_carpeta_raiz . "/" . $nombre_imagen_adicional;
                move_uploaded_file($tmp_name, $ruta_imagen_adicional);
            }
        }
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Producto registrado'];
    } else {
        $_SESSION['alert'] = ['type' => 'warning', 'message' => 'Alguno de los campos está vacío'];
    }
    header("Location: productos.php");
    exit;
}
// Eliminar Producto
if (!empty($_POST["eliminar_producto"])) {
    $id = $_POST["id"];
    try {
        // Preparar la consulta
        $stmt = $con->prepare("DELETE FROM productos WHERE id = ?");
        // Ejecutar la consulta con el parámetro vinculado
        $stmt->execute([$id]);
        // Verificar si se eliminó correctamente
        if ($stmt->rowCount() > 0) {
            $_SESSION['alert'] = ['type' => 'info', 'message' => 'Producto eliminado correctamente'];
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error al eliminar el producto'];
        }
    } catch (PDOException $e) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Error en la consulta SQL: ' . $e->getMessage()];
    }
    header("Location: productos.php");
    exit;
}
?>
