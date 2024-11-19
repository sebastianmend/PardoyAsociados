<?php

class Inventario {
    private $conexion;

    public function __construct($host, $usuario, $password, $baseDatos) {
        $this->conexion = new mysqli($host, $usuario, $password, $baseDatos);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    // Crear un nuevo objeto
    public function crear_objeto($nombre, $descripcion, $cantidad, $precio) {
        $sql = "INSERT INTO inventario (nombre, descripcion, cantidad, precio) VALUES (?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssid", $nombre, $descripcion, $cantidad, $precio);

        if ($stmt->execute()) {
            return "Objeto creado exitosamente.";
        } else {
            return "Error al crear el objeto: " . $stmt->error;
        }
    }

    // Eliminar un objeto
    public function eliminar_objeto($id) {
        $sql = "DELETE FROM inventario WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return "Objeto eliminado exitosamente.";
        } else {
            return "Error al eliminar el objeto: " . $stmt->error;
        }
    }

    // Listar todos los objetos
    public function listar_objeto() {
        $sql = "SELECT * FROM inventario";
        $resultado = $this->conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $objetos = [];
            while ($fila = $resultado->fetch_assoc()) {
                $objetos[] = $fila;
            }
            return $objetos;
        } else {
            return "No hay objetos en el inventario.";
        }
    }

    // Editar un objeto
    public function editar_objeto($id, $nombre, $descripcion, $cantidad, $precio) {
        $sql = "UPDATE inventario SET nombre = ?, descripcion = ?, cantidad = ?, precio = ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ssidi", $nombre, $descripcion, $cantidad, $precio, $id);

        if ($stmt->execute()) {
            return "Objeto editado exitosamente.";
        } else {
            return "Error al editar el objeto: " . $stmt->error;
        }
    }

    // Procesar algo (por ejemplo, aumentar o disminuir stock)
    public function procesar($id, $cantidadAjuste) {
        $sql = "UPDATE inventario SET cantidad = cantidad + ? WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("ii", $cantidadAjuste, $id);

        if ($stmt->execute()) {
            return "Cantidad procesada exitosamente.";
        } else {
            return "Error al procesar la cantidad: " . $stmt->error;
        }
    }
}

?>
