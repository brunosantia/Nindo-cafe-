<?php
require_once "../config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accion'], $_POST['id'])) {
    $accion = $_POST['accion'];
    $id = $_POST['id'];

    if ($accion === 'eliminar_producto') {
        // Evitar inyección de SQL usando una declaración preparada
        $query = mysqli_prepare($conexion, "DELETE FROM productos WHERE id = ?");
        mysqli_stmt_bind_param($query, "i", $id);
        mysqli_stmt_execute($query);

        if (mysqli_stmt_affected_rows($query) > 0) {
            // La eliminación fue exitosa
            mysqli_stmt_close($query);
            mysqli_close($conexion);
            header('Location: productos.php');
            exit();
        } else {
            // No se eliminó ninguna fila, manejar el error según sea necesario
            echo "Error al intentar eliminar el producto.";
        }
    } elseif ($accion === 'eliminar_categoria') {
        // Código para eliminar una categoría
        // Agrega el código necesario para eliminar la categoría aquí
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Redireccionar a una página de error o manejar la situación según sea necesario
    echo "Solicitud no válida.";
}
?>
