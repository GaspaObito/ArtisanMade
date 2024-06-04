<?php 
include ('includes/header.php');
// Definir la variable para indicar el tipo de datos
$tipo_datos = isset($_GET['tipo']) ? $_GET['tipo'] : '';
// Determinar qué consulta SQL ejecutar según el tipo de datos
if ($tipo_datos == 'Clientes') {
    $sql = $con->query("SELECT * FROM clientes");
    $encabezados = array('id', 'nombres', 'apellidos', 'email', 'telefono', 'dni', 'estatus', 'fecha_alta');
} elseif ($tipo_datos == 'Compras') {
    $sql = $con->query("SELECT * FROM compra");
    $encabezados = array('id_transaccion', 'fecha', 'status', 'email', 'id_cliente', 'total');
}elseif ($tipo_datos == 'detalles_Producto') {
    $sql = $con->query("SELECT * FROM detalle_compra");
    $encabezados = array('id_compra', 'id_producto', 'nombre', 'precio', 'cantidad');
} else {
    // Manejar el caso en que no se especifique ningún tipo de datos
    echo "No se especificó ningún tipo de datos válido.";
    exit;
}
?>
<section class="section container">
    <h2 class="section__title"><?php echo ucfirst($tipo_datos); ?></h2>  
    <div class="table-responsive">
        <table class="table">
            <thead class="bg-info">
                <tr>
                    <?php 
                    // Mostrar los encabezados de la tabla
                    foreach ($encabezados as $encabezado) {
                        echo "<th scope='col'>$encabezado</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar los datos de la consulta
                foreach ($sql as $datos) {
                    echo "<tr>";
                    foreach ($encabezados as $campo) {
                        echo "<td>{$datos[$campo]}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<?php include ('includes/footer.php'); ?>
