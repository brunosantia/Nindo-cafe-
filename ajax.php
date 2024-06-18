<?php
require_once "config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'buscar') {
    $productos_en_carrito = array(); // Para llevar un registro de los productos y sus cantidades
    $total = 0;

    // Filtrar y validar los datos del POST
    $data = filter_input(INPUT_POST, 'data', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

    if ($data && is_array($data)) {
        foreach ($data as $producto) {
            $id = filter_var($producto['id'], FILTER_VALIDATE_INT);

            if ($id !== false) {
                $query = mysqli_prepare($conexion, "SELECT * FROM productos WHERE id = ?");
                mysqli_stmt_bind_param($query, "i", $id);
                mysqli_stmt_execute($query);
                $result = mysqli_stmt_get_result($query);

                if ($row = mysqli_fetch_assoc($result)) {
                    $clave_producto = $row['id'];

                    if (array_key_exists($clave_producto, $productos_en_carrito)) {
                        $productos_en_carrito[$clave_producto]['cantidad']++;
                    } else {
                        $productos_en_carrito[$clave_producto] = array(
                            'id' => $row['id'],
                            'id_categoria' => $row['id_categoria'],
                            'precio_normal' => $row['precio_normal'],
                            'nombre' => $row['nombre'],
                            'cantidad' => 1
                        );
                    }

                    $total += $row['precio_normal'];
                }
            }
        }
    }

    // Agregar los productos del carrito al array final
    $array['datos'] = array_values($productos_en_carrito); // Reindexar el array
    $array['total'] = $total;

    echo json_encode($array);
    die();
}
?>
