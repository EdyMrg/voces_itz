<?php
// admin.php
// Conexión a la base de datos en InfinityFree
$servidor = "sql303.infinityfree.com";
$usuario = "if0_42021003";
$contrasena = "vec14RKwdYn6";
$base_datos = "if0_42021003_voces_itz";

$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// LÓGICA PARA DAR DE BAJA REGISTROS POR DÍA
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_dia'])) {
    $fecha_eliminar = $conexion->real_escape_string($_POST['fecha_control']);
    
    if (!empty($fecha_eliminar)) {
        // SQL para eliminar registros que coincidan con la fecha (ignorando la hora)
        $sql_delete = "DELETE FROM reportes_inmediatos WHERE DATE(fecha_reporte) = '$fecha_eliminar'";
        
        if ($conexion->query($sql_delete) === TRUE) {
            $registros_eliminados = $conexion->affected_rows;
            echo "<script>
                    alert('Control de día cerrado: Se dieron de baja exitosamente $registros_eliminados registros del día $fecha_eliminar.');
                    window.location.href = 'admin.php';
                  </script>";
        } else {
            echo "<script>alert('Error al procesar la baja: " . $conexion->error . "');</script>";
        }
    }
}

// Consultas para obtener datos actuales de la tabla
$sql_reportes = "SELECT * FROM reportes_inmediatos ORDER BY fecha_reporte DESC";
$resultado_reportes = $conexion->query($sql_reportes);
$total_reportes = $resultado_reportes->num_rows;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Voces ITZ</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body style="background-color: #F4F4F9;">
    <nav class="navbar">
        <div class="logo">Voces ITZ | Panel de Control (Admin)</div>
        <ul class="nav-links">
            <li><a href="index.php">Ver Portal</a></li>
            <li><a href="login.html" class="btn-logout" style="border-color: #E74C3C; color: #E74C3C;">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <main class="admin-container">
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-file-alt stat-icon"></i>
                <div class="stat-info">
                    <h3><?php echo $total_reportes; ?></h3>
                    <p>Total de Reportes Registrados</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-users stat-icon"></i>
                <div class="stat-info">
                    <h3>Atención</h3>
                    <p>Canalización al Comité</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-shield-alt stat-icon"></i>
                <div class="stat-info">
                    <h3>Confidencial</h3>
                    <p>Datos encriptados (Localhost)</p>
                </div>
            </div>
        </div>

        <div class="admin-actions-layout">
            <div class="action-card-box block-delete">
                <h3><i class="fas fa-calendar-minus"></i> Cierre y Control por Día</h3>
                <p>Selecciona una fecha específica para dar de baja de forma definitiva todos los registros correspondientes a ese día.</p>
                
                <form action="admin.php" method="POST" onsubmit="return confirm('⚠️ ATENCIÓN: Estás a punto de dar de baja TODOS los reportes del día seleccionado de la base de datos. Esta acción no se puede deshacer. ¿Deseas continuar?');">
                    <div class="form-group-inline">
                        <input type="date" name="fecha_control" required max="<?php echo date('Y-m-d'); ?>">
                        <button type="submit" name="eliminar_dia" class="btn-action-delete">
                            <i class="fas fa-trash-alt"></i> Dar de Baja Día
                        </button>
                    </div>
                </form>
            </div>

            <div class="action-card-box block-export">
                <h3><i class="fas fa-print"></i> Exportación de Evidencias</h3>
                <p>Genera el documento en formato horizontal optimizado con los registros visibles en el sistema para la entrega oficial al plantel.</p>
                <button onclick="generarPDF()" class="btn-export">
                    <i class="fas fa-file-pdf"></i> Generar PDF Oficial
                </button>
            </div>
        </div>

        <div id="zonaReportePDF" class="reporte-oficial-box">
            <div class="pdf-header">
                <h2>Instituto Tecnológico de Zacatepec</h2>
                <h3>Reporte Confidencial de Prevención - Plataforma Voces ITZ</h3>
                <p>Fecha de emisión: <?php echo date("Y-m-d H:i:s"); ?></p>
                <hr>
            </div>
            
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha y Hora</th>
                            <th>Denunciante</th>
                            <th>No. Control</th>
                            <th>Carrera</th>
                            <th>Hechos Detallados</th>
                            <th>Agresor Identificado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($total_reportes > 0) {
                            while($fila = $resultado_reportes->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $fila["id"] . "</td>";
                                echo "<td>" . $fila["fecha_reporte"] . "</td>";
                                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                                echo "<td>" . htmlspecialchars($fila["numero_control"]) . "</td>";
                                echo "<td>" . htmlspecialchars($fila["carrera"]) . "</td>";
                                echo "<td>" . htmlspecialchars($fila["descripcion_hechos"]) . "</td>";
                                echo "<td>" . htmlspecialchars($fila["identificacion_agresor"]) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align:center;'>No hay reportes de acción inmediata registrados en la base de datos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="pdf-footer">
                <p><em>Este documento contiene información sensible y confidencial. Su distribución no autorizada está estrictamente prohibida.</em></p>
            </div>
        </div>
    </main>

    <script>
        function generarPDF() {
            const elemento = document.getElementById('zonaReportePDF');
            const opciones = {
                margin:       10,
                filename:     'Reporte_Oficial_VocesITZ.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };
            alert("Generando el archivo PDF oficial, por favor espera un momento...");
            html2pdf().set(opciones).from(elemento).save();
        }
    </script>
</body>
</html>
<?php $conexion->close(); ?>
