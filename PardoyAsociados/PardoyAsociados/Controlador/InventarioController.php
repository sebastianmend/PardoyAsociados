<?php
require_once "app/modelo/Inventario.php";

class InventarioController {
    private $modelo;

    public function __construct() {
        $db = new Database();
        $this->modelo = new Inventario($db);
    }

    public function listar() {
        $objetos = $this->modelo->listar();
        require_once "app/vistas/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];

            $this->modelo->crear($nombre, $descripcion, $cantidad, $precio);
            header("Location: index.php");
        } else {
            require_once "app/vistas/crear.php";
        }
    }

    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $cantidad = $_POST['cantidad'];
            $precio = $_POST['precio'];

            $this->modelo->editar($id, $nombre, $descripcion, $cantidad, $precio);
            header("Location: index.php");
        } else {
            $id = $_GET['id'];
            $objeto = $this->modelo->listar()->fetch_assoc();
            require_once "app/vistas/editar.php";
        }
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->modelo->eliminar($id);
        header("Location: index.php");
    }
}
?>

-- Creación de la base de datos
CREATE DATABASE GestionEmpresa;
USE GestionEmpresa;

-- Tabla Productos
CREATE TABLE Productos (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    nombre_producto VARCHAR(100) NOT NULL,
    tipo_producto VARCHAR(50),
    cantidad_disponible INT DEFAULT 0,
    precio_unitario DECIMAL(10, 2),
    unidad_medida VARCHAR(20),
    estado_rotacion VARCHAR(50)
);

-- Tabla Inventario
CREATE TABLE Inventario (
    id_inventario INT PRIMARY KEY AUTO_INCREMENT,
    id_producto INT NOT NULL,
    fecha_entrada DATE,
    cantidad_entrada INT,
    fecha_salida DATE,
    cantidad_salida INT,
    ubicacion_almacen VARCHAR(100),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

-- Tabla Clientes
CREATE TABLE Clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nombre_cliente VARCHAR(100) NOT NULL,
    tipo_cliente VARCHAR(50),
    direccion VARCHAR(255),
    telefono VARCHAR(20),
    email VARCHAR(100),
    fecha_registro DATE
);

-- Tabla Pedidos
CREATE TABLE Pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT NOT NULL,
    fecha_pedido DATE NOT NULL,
    estado_pedido VARCHAR(50),
    fecha_entrega_estimada DATE,
    fecha_entrega_real DATE,
    detalles_pedido TEXT,
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente)
);

-- Tabla Producción
CREATE TABLE Produccion (
    id_produccion INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad_procesada INT,
    fecha_inicio_produccion DATE,
    fecha_fin_produccion DATE,
    estado_proceso VARCHAR(50),
    observaciones TEXT,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

-- Tabla Vendedores
CREATE TABLE Vendedores (
    id_vendedor INT PRIMARY KEY AUTO_INCREMENT,
    nombre_vendedor VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100),
    zona_asignada VARCHAR(100)
);

-- Tabla Visitas
CREATE TABLE Visitas (
    id_visita INT PRIMARY KEY AUTO_INCREMENT,
    id_vendedor INT NOT NULL,
    id_cliente INT NOT NULL,
    fecha_visita DATE,
    observaciones TEXT,
    ubicacion_visita VARCHAR(100),
    FOREIGN KEY (id_vendedor) REFERENCES Vendedores(id_vendedor),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente)
);

