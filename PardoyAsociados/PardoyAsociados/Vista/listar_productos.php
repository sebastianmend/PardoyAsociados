<?php include '../Modelo/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Listado de Productos</h2>

        <a href="index.php" class="btn btn-secondary mb-3">Regresar al Inicio</a>

        <?php
        $sql = "SELECT * FROM Productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>ID Producto</th><th>Nombre</th><th>Tipo</th><th>Cantidad</th><th>Precio Unitario</th><th>Acciones</th></tr></thead><tbody>";
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_producto'] . "</td>";
                echo "<td>" . $row['nombre_producto'] . "</td>";
                echo "<td>" . $row['tipo_producto'] . "</td>";
                echo "<td>" . $row['cantidad_disponible'] . "</td>";
                echo "<td>" . $row['precio_unitario'] . "</td>";
                echo "<td>
                        <a href='editar_producto.php?id=" . $row['id_producto'] . "' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='eliminar_producto.php?id=" . $row['id_producto'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Seguro que quieres eliminar este producto?\");'>Eliminar</a>
                    </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning'>No hay productos registrados.</div>";
        }
        ?>
    </div>
</body>
</html>
