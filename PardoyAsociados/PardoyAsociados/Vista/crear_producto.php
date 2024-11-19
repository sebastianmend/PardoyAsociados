<?php include '../Modelo/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Crear Nuevo Producto</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener datos del formulario
            $id_producto = $_POST['id_producto'];
            $nombre_producto = $_POST['nombre_producto'];
            $tipo_producto = $_POST['tipo_producto'];
            $cantidad_disponible = $_POST['cantidad_disponible'];
            $precio_unitario = $_POST['precio_unitario'];
            $unidad_medida = $_POST['unidad_medida'];
            $estado_rotacion = $_POST['estado_rotacion'];

            // Insertar el producto en la base de datos
            $sql = "INSERT INTO Productos (id_producto, nombre_producto, tipo_producto, cantidad_disponible, precio_unitario, unidad_medida, estado_rotacion)
                    VALUES ('$id_producto', '$nombre_producto', '$tipo_producto', '$cantidad_disponible', '$precio_unitario', '$unidad_medida', '$estado_rotacion')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Producto creado correctamente</div>";
                echo "<a href='crear_inventario.php' class='btn btn-primary'>Volver al Inventario</a>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        } else {
            $id_producto = $_GET['id_producto'] ?? '';
        }
        ?>

        <!-- Formulario para crear un producto -->
        <form method="POST">
        <div class="mb-3">
            <label for="id_producto" class="form-label">ID Producto</label>
            <input type="number" class="form-control" id="id_producto" name="id_producto" required>
            </div>
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
            </div>
            <div class="mb-3">
                <label for="tipo_producto" class="form-label">Tipo de Producto</label>
                <input type="text" class="form-control" id="tipo_producto" name="tipo_producto" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" required>
            </div>
            <div class="mb-3">
                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" required>
            </div>
            <div class="mb-3">
                <label for="estado_rotacion" class="form-label">Estado de Rotación</label>
                <input type="text" class="form-control" id="estado_rotacion" name="estado_rotacion" required>
            </div>
            <button type="submit" class="btn btn-primary">Crear Producto</button>
            <a href="crear_inventario.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
