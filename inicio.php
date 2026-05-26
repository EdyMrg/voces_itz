<?php
// Conexión a la base de datos
$servidor = "sql303.infinityfree.com";
$usuario = "if0_42021003";
$contrasena = "vec14RKwdYn6";
$base_datos = "if0_42021003_voces_itz"; // <-- Aquí estaba el detalle

$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los testimonios ordenados del más reciente al más antiguo
$sql_testimonios = "SELECT * FROM testimonios ORDER BY fecha DESC";
$resultado_testimonios = $conexion->query($sql_testimonios);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prevención de Micromachismos - ITZ</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">ITZ | Portal de Equidad Estudiantil</div>
        <ul class="nav-links">
            <li><a href="#inicio">Inicio</a></li>
            <li><a href="#teoria">Marco Teórico</a></li>
            <li><a href="#ejemplos">Casos Frecuentes</a></li>
            <li><a href="#comparte">Testimonios</a></li>
            <li><a href="#ayuda">Líneas de Ayuda</a></li>
            <li><a href="login.html" class="btn-logout">Cerrar Sesión</a></li>
        </ul>
    </nav>

    <header id="inicio" class="hero">
        <div class="hero-content">
            <h1>Campaña de Concientización y Prevención</h1>
            <p>Erradicando la normalización de micromachismos en la Ingeniería y áreas afines.</p>
        </div>
    </header>

    <main>
        <section id="teoria" class="info-section">
            <h2>¿Qué son los Micromachismos?</h2>
            <p class="section-desc">El término define aquellas prácticas, actitudes y comportamientos sutiles, cotidianos y casi imperceptibles que perpetúan la desigualdad de género. Están tan normalizados en nuestra cultura que suelen pasar desapercibidos.</p>
            
            <h3 class="subtitulo-seccion">Clasificación Principal</h3>
            <div class="cards-container">
                <div class="card">
                    <div class="card-icon">⚠️</div>
                    <h3>Coercitivos</h3>
                    <p>Buscan retener el poder a través de la presión. En lo académico, ocurre al monopolizar la palabra, desautorizar públicamente a una compañera o imponer decisiones en equipo.</p>
                </div>
                <div class="card">
                    <div class="card-icon">🎭</div>
                    <h3>Encubiertos</h3>
                    <p>Los más sutiles; se disfrazan de paternalismo. Incluyen el <em>mansplaining</em> o la sobreprotección que anula la autonomía de las estudiantes en prácticas.</p>
                </div>
                <div class="card">
                    <div class="card-icon">🛑</div>
                    <h3>De Crisis</h3>
                    <p>Surgen cuando las mujeres asumen posiciones de liderazgo en áreas predominantemente masculinas. Se manifiestan con críticas al carácter o boicot pasivo.</p>
                </div>
            </div>
        </section>

        <section id="ejemplos" class="info-section bg-light">
            <h2>La Realidad en los Talleres y Laboratorios</h2>
            <p class="section-desc">Dentro del Instituto, y particularmente en carreras de Ingeniería, estas conductas se manifiestan en situaciones específicas:</p>
            
            <div class="list-container">
                <ul class="custom-list">
                    <li><strong>División sexista del trabajo:</strong> Asignar a las mujeres la redacción del reporte, mientras los hombres asumen la programación o el manejo de maquinaria (tornos, fresadoras).</li>
                    <li><strong>Subestimación técnica:</strong> Cuestionar repetidamente los cálculos o el diseño de una compañera hasta que un compañero varón los valida.</li>
                    <li><strong>Exclusión informal:</strong> Dejar fuera a compañeras de grupos de estudio asumiendo que "no aguantan la carrilla".</li>
                    <li><strong>Microagresiones:</strong> Uso de chistes sexistas en los laboratorios como forma de crear "camaradería".</li>
                </ul>
            </div>
        </section>

        <section id="ayuda" class="help-section">
            <h2>Recursos de Apoyo y Contactos de Emergencia</h2>
            <p class="section-desc">No estás sola. Si sufres de violencia, acoso o discriminación, existen instituciones en Morelos y a nivel federal listas para apoyarte.</p>
            
            <div class="help-cards">
                <div class="help-card">
                    <h3>📞 Emergencias y Seguridad</h3>
                    <p>Para situaciones de riesgo inminente dentro o fuera del plantel.</p>
                    <a href="tel:911" class="btn-help">Llamar al 911</a>
                </div>
                <div class="help-card">
                    <h3>💜 Instituto de la Mujer (Morelos)</h3>
                    <p>Atención psicológica y asesoría legal gratuita.</p>
                    <a href="tel:7773220459" class="btn-help">Tel: 777 322 0459</a>
                </div>
                <div class="help-card">
                    <h3>🧠 Línea de la Vida</h3>
                    <p>Atención psicológica especializada 24/7 a nivel nacional.</p>
                    <a href="tel:8009112000" class="btn-help">Tel: 800 911 2000</a>
                </div>
            </div>
            
            <div class="protocol-box">
                <h3>¿Qué hacer en caso de acoso en el Instituto?</h3>
                <ol>
                    <li><strong>Resguárdate:</strong> Acude a un lugar seguro o acompáñate de personas de confianza.</li>
                    <li><strong>Documenta:</strong> Guarda mensajes, correos, anota fechas, horas y posibles testigos.</li>
                    <li><strong>Reporta:</strong> Utiliza nuestro botón de Acción Inmediata o acude directamente a la subdirección académica.</li>
                </ol>
            </div>
        </section>

        <section id="comparte" class="share-section">
            <div class="share-container">
                <h2>Muro de Testimonios Anónimos</h2>
                <p>Este es un espacio institucional seguro. Exponer estas dinámicas nos ayuda a medir el clima estudiantil.</p>
                
                <div class="testimonios-list">
                    <?php if ($resultado_testimonios->num_rows > 0): ?>
                        <?php while($testimonio = $resultado_testimonios->fetch_assoc()): ?>
                            <div class="testimonio-card">
                                <h4><i class="fas fa-quote-left"></i> <?php echo htmlspecialchars($testimonio['contexto']); ?></h4>
                                <p><?php echo nl2br(htmlspecialchars($testimonio['historia'])); ?></p>
                                <small>Publicado el: <?php echo date("d/m/Y", strtotime($testimonio['fecha'])); ?></small>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="no-testimonios">Sé la primera persona en compartir su testimonio. Tu voz es importante.</p>
                    <?php endif; ?>
                </div>

                <hr style="margin: 2rem 0; border: 1px solid #ddd;">

                <form class="story-form" action="procesar_testimonio.php" method="POST">
                    <input type="text" name="contexto" placeholder="Contexto (Ej. Práctica de Termodinámica...)" required>
                    <textarea name="historia" rows="4" placeholder="Describe la situación vivida. Omite nombres propios..." required></textarea>
                    <button type="submit" class="btn-primary">Publicar Testimonio</button>
                </form>
            </div>
        </section>
    </main>

    <button id="btnFlotante" class="btn-flotante">
        🚨 Reporte Inmediato
    </button>

    <div id="modalReporte" class="modal">
        <div class="modal-contenido">
            <span class="cerrar-modal">&times;</span>
            <h2 class="modal-titulo">Canal de Denuncia Interna</h2>
            <p class="modal-desc">La información aquí proporcionada es estrictamente confidencial y será canalizada a las autoridades correspondientes del plantel.</p>
            
            <form id="formAccionInmediata" action="procesar_reporte.php" method="POST">
                <div class="input-group">
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="input-group">
                    <label for="control">Número de Control:</label>
                    <input type="text" id="control" name="control" placeholder="Ej. L20340000" required>
                </div>
                <div class="input-group">
                    <label for="carrera">Programa Educativo:</label>
                    <select id="carrera" name="carrera" required>
                        <option value="">Selecciona tu carrera...</option>
                        <option value="Ingeniería Electromecánica">Ingeniería Electromecánica</option>
                        <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                        <option value="Ingeniería Civil">Ingeniería Civil</option>
                        <option value="Ingeniería en Administración">Ingeniería en Administración</option>
                        <option value="Ingeniería Bioquímica">Ingeniería Bioquímica</option>
                        <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                        <option value="Licenciatura Turismo">Licenciatura Turismo</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="caso">Descripción de los hechos:</label>
                    <textarea id="caso" name="caso" rows="3" placeholder="Detalla lugar, fecha y cómo ocurrieron los hechos..." required></textarea>
                </div>
                <div class="input-group">
                    <label for="agresor">Identificación de la persona agresora:</label>
                    <textarea id="agresor" name="agresor" rows="2" placeholder="Nombre completo, cargo (docente, administrativo, estudiante)..." required></textarea>
                </div>
                <button type="submit" class="btn-urgente">Registrar Reporte Oficial</button>
            </form>
        </div>
    </div>

    <footer>
        <p><strong>Instituto Tecnológico de Zacatepec</strong></p>
        <p>Proyecto - Ingeniería en Sistemas Computacionales</p>
    </footer>

    <script src="app.js"></script>
</body>
</html>
<?php $conexion->close(); ?>
