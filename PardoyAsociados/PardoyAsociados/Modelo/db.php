<?php
// db.php - Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GestionEmpresa";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
