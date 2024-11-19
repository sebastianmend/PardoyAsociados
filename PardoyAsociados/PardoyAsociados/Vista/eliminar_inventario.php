<?php
include '../Modelo/db.php';;

// Verificar si se pasa el ID en la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro
    $sql = "DELETE FROM Inventario WHERE id_inventario = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registro eliminado correctamente');
                window.location.href = 'listar_inventario.php';
                </script>";
    } else {
        echo "<script>
                alert('Error al eliminar: " . $conn->error . "');
                window.location.href = 'listar_inventario.php';
                </script>";
    }
} else {
    echo "<script>
            alert('ID no especificado');
            window.location.href = 'listar_inventario.php';
            </script>";
}
?>
