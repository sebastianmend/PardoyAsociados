<?php include '../Modelo/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar al Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Agregar al Inventario</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id_producto = $_POST['id_producto'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $cantidad_entrada = $_POST['cantidad_entrada'];
            $fecha_salida = $_POST['fecha_salida'] ?? null;
            $cantidad_salida = $_POST['cantidad_salida'] ?? 0;
            $ubicacion_almacen = $_POST['ubicacion_almacen'];

            // Verificar si el producto existe en la tabla Productos
            $sql_check = "SELECT * FROM Productos WHERE id_producto = '$id_producto'";
            $result = $conn->query($sql_check);

            if ($result->num_rows == 0) {
                // Producto no encontrado
                echo "<div class='alert alert-danger'>El producto con ID $id_producto no existe. 
                       ¿Quieres crearlo?</div>";
            } else {
                // Producto existe, proceder con la inserción en Inventario
                $sql = "INSERT INTO Inventario (id_producto, fecha_entrada, cantidad_entrada, fecha_salida, cantidad_salida, ubicacion_almacen)
                        VALUES ('$id_producto', '$fecha_entrada', '$cantidad_entrada', " . ($fecha_salida ? "'$fecha_salida'" : "NULL") . ", '$cantidad_salida', '$ubicacion_almacen')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Registro agregado correctamente</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                }
            }
        }
        ?>

        <!-- Formulario para agregar al inventario -->
        <form method="POST">
            <div class="mb-3">
            <label for="id_producto" class="form-label">ID Producto</label>
            <input type="number" class="form-control" id="id_producto" name="id_producto" required>
            </div>
            <div class="mb-3">
                <label for="fecha_entrada" class="form-label">Fecha de Entrada</label>
                <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_entrada" class="form-label">Cantidad Entrada</label>
                <input type="number" class="form-control" id="cantidad_entrada" name="cantidad_entrada" required>
            </div>
            <div class="mb-3">
                <label for="fecha_salida" class="form-label">Fecha de Salida (opcional)</label>
                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida">
            </div>
            <div class="mb-3">
                <label for="cantidad_salida" class="form-label">Cantidad Salida (opcional)</label>
                <input type="number" class="form-control" id="cantidad_salida" name="cantidad_salida">
            </div>
            <div class="mb-3">
                <label for="ubicacion_almacen" class="form-label">Ubicación del Almacén</label>
                <input type="text" class="form-control" id="ubicacion_almacen" name="ubicacion_almacen" required>
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Agregar</button>
                <a href="crear_producto.php" class="btn btn-primary">Crear Producto</a>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
