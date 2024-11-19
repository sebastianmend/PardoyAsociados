<?php include '../Modelo/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Editar Inventario</h2>

        <?php
        // Verificar si se pasa el ID en la URL
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener los datos del registro
            $sql = "SELECT * FROM Inventario WHERE id_inventario = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "<div class='alert alert-danger'>Registro no encontrado</div>";
                exit;
            }
        } else {
            echo "<div class='alert alert-danger'>ID no especificado</div>";
            exit;
        }

        // Procesar la actualización
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id_producto'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $cantidad_entrada = $_POST['cantidad_entrada'];
            $ubicacion_almacen = $_POST['ubicacion_almacen'];

            $sql = "UPDATE Inventario 
                    SET id_producto = '$id_producto', fecha_entrada = '$fecha_entrada', cantidad_entrada = '$cantidad_entrada', ubicacion_almacen = '$ubicacion_almacen'
                    WHERE id_inventario = $id";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success mt-3'>Registro actualizado correctamente</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
            }
        }
        ?>

        <form method="POST">
            <div class="mb-3">
                <label for="id_producto" class="form-label">ID Producto</label>
                <input type="number" class="form-control" id="id_producto" name="id_producto" value="<?= $row['id_producto'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_entrada" class="form-label">Fecha de Entrada</label>
                <input type="date" class="form-control" id="fecha_entrada" name="fecha_entrada" value="<?= $row['fecha_entrada'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_entrada" class="form-label">Cantidad Entrada</label>
                <input type="number" class="form-control" id="cantidad_entrada" name="cantidad_entrada" value="<?= $row['cantidad_entrada'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="ubicacion_almacen" class="form-label">Ubicación</label>
                <input type="text" class="form-control" id="ubicacion_almacen" name="ubicacion_almacen" value="<?= $row['ubicacion_almacen'] ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar</button>
            <a href="listar_inventario.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
