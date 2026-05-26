<?php
// procesar_testimonio.php
$servidor = "sql303.infinityfree.com";
$usuario = "if0_42021003";
$contrasena = "vec14RKwdYn6";
$base_datos = "if0_42021003_voces_itz";

$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contexto = $conexion->real_escape_string($_POST['contexto']);
    $historia = $conexion->real_escape_string($_POST['historia']);

    $sql = "INSERT INTO testimonios (contexto, historia) VALUES ('$contexto', '$historia')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>
                alert('Tu testimonio ha sido publicado de forma anónima. Gracias por compartir.');
                window.location.href = 'index.php#comparte';
              </script>";
    } else {
        echo "Error al publicar: " . $conexion->error;
    }
}

$conexion->close();
?>
