<?php
// procesar_reporte.php

// Credenciales por defecto de XAMPP
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "voces_itz";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se enviaron los datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar los datos para mayor seguridad
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $control = $conexion->real_escape_string($_POST['control']);
    $carrera = $conexion->real_escape_string($_POST['carrera']);
    $caso = $conexion->real_escape_string($_POST['caso']);
    $agresor = $conexion->real_escape_string($_POST['agresor']);

    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO reportes_inmediatos (nombre, numero_control, carrera, descripcion_hechos, identificacion_agresor) 
            VALUES ('$nombre', '$control', '$carrera', '$caso', '$agresor')";

    if ($conexion->query($sql) === TRUE) {
        // Redirigir de vuelta con un mensaje de éxito
        echo "<script>
                alert('Reporte registrado exitosamente. Tu información está segura y será canalizada.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

$conexion->close();
?>