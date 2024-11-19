<?php include '../Modelo/db.php';;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM Productos WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Producto eliminado correctamente.');
                window.location.href = 'listar_productos.php';
                </script>";
    } else {
        echo "<script>
                alert('Error al eliminar el producto.');
                window.location.href = 'listar_productos.php';
                </script>";
    }
} else {
    echo "<script>
            alert('ID no especificado.');
            window.location.href = 'listar_productos.php';
            </script>";
}
?>
