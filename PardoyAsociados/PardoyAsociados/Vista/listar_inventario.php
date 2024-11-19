<?php include '../Modelo/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Inventario</h2>
        <a href="index.php" class="btn btn-secondary mb-3">Volver</a>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID  Inventario</th>
                    <th>ID Producto</th>
                    <th>Fecha Entrada</th>
                    <th>Cantidad Entrada</th>
                    <th>Ubicación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM Inventario";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id_inventario']}</td>
                            <td>{$row['id_producto']}</td>
                            <td>{$row['fecha_entrada']}</td>
                            <td>{$row['cantidad_entrada']}</td>
                            <td>{$row['ubicacion_almacen']}</td>
                            <td>
                                <a href='editar_inventario.php?id={$row['id_inventario']}' class='btn btn-warning btn-sm'>Editar</a>
                                <a href='eliminar_inventario.php?id={$row['id_inventario']}' class='btn btn-danger btn-sm'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay registros</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
