<?php include '../Modelo/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Editar Producto</h2>

        <?php
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM Productos WHERE id_producto = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<div class='alert alert-danger'>Producto no encontrado.</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>ID no especificado.</div>";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = htmlspecialchars($_POST['nombre_producto']);
            $tipo = htmlspecialchars($_POST['tipo_producto']);
            $cantidad = intval($_POST['cantidad_disponible']);
            $precio = floatval($_POST['precio_unitario']);
            $unidad = htmlspecialchars($_POST['unidad_medida']);
            $estado = htmlspecialchars($_POST['estado_rotacion']);

            $sql = "UPDATE Productos 
                    SET nombre_producto = ?, tipo_producto = ?, cantidad_disponible = ?, precio_unitario = ?, unidad_medida = ?, estado_rotacion = ?
                    WHERE id_producto = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssidssi", $nombre, $tipo, $cantidad, $precio, $unidad, $estado, $id);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Producto actualizado correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" value="<?= htmlspecialchars($row['nombre_producto']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="tipo_producto" class="form-label">Tipo de Producto</label>
                <input type="text" class="form-control" id="tipo_producto" name="tipo_producto" value="<?= htmlspecialchars($row['tipo_producto']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible" value="<?= $row['cantidad_disponible'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio_unitario" class="form-label">Precio Unitario</label>
                <input type="number" class="form-control" id="precio_unitario" name="precio_unitario" step="0.01" value="<?= $row['precio_unitario'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" value="<?= htmlspecialchars($row['unidad_medida']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="estado_rotacion" class="form-label">Estado de Rotación</label>
                <input type="text" class="form-control" id="estado_rotacion" name="estado_rotacion" value="<?= htmlspecialchars($row['estado_rotacion']) ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Producto</button>
            <a href="listar_productos.php" class="btn btn-secondary">Regresar a la Lista</a>
        </form>
    </div>
</body>
</html>
