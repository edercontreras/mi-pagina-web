<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tienes un usuario diferente
$password = "";  // Cambia esto si tienes una contraseña
$dbname = "tienda_online";  // Asegúrate de que este sea el nombre correcto de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>