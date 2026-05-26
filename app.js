document.addEventListener('DOMContentLoaded', () => {
    
   // ==========================================
    // LÓGICA DE ACCESO (login.html)
    // ==========================================
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault(); 
            
            const emailInput = document.getElementById('email').value.trim();
            const passwordInput = document.getElementById('password').value.trim();
            const errorMsg = document.getElementById('loginError'); 

            // 1. VERIFICACIÓN DE ADMINISTRADOR (Alta Prioridad)
            if (emailInput === "L22090701@zacatepec.tecnm.mx" && passwordInput === "Admin22090701") {
                errorMsg.style.display = "none";
                alert("¡Acceso de Administrador validado! Ingresando al panel de control...");
                window.location.href = "/voces_itz/admin.php"; 
                return; // Detenemos la ejecución aquí para que no siga validando como estudiante
            }
            
            // 2. VERIFICACIÓN DE ESTUDIANTE REGULAR
            const emailRegex = /^[Ll]\d{8}@zacatepec\.tecnm\.mx$/;
            const passwordRegex = /^\d{8}[A-Z][a-z]+$/;

            let errores = [];

            if (!emailRegex.test(emailInput)) {
                errores.push("❌ Correo inválido. Ej: L20340000@zacatepec.tecnm.mx");
            }
            if (!passwordRegex.test(passwordInput)) {
                errores.push("❌ Contraseña inválida. Ej: 22340000Pepe");
            }

            if (errores.length > 0) {
                errorMsg.innerHTML = errores.join("<br>");
                errorMsg.style.display = "block";
            } else {
                errorMsg.style.display = "none";
                alert("¡Acceso validado! Redirigiendo al portal...");
                window.location.href = "/voces_itz/index.php"; 
            }
        });
    }

    // ==========================================
    // LÓGICA DEL CUESTIONARIO FLOTANTE (index.html)
    // ==========================================
    const modal = document.getElementById("modalReporte");
    const btnFlotante = document.getElementById("btnFlotante");
    
    // Como el login no tiene la clase .cerrar-modal, verificamos que exista antes de usarla
    const cerrarModalElementos = document.getElementsByClassName("cerrar-modal");
    const spanCerrar = cerrarModalElementos.length > 0 ? cerrarModalElementos[0] : null;

    if (btnFlotante && modal) {
        btnFlotante.onclick = function() {
            modal.style.display = "block";
            document.body.style.overflow = "hidden"; // Quita el scroll de fondo
        }
    }

    if (spanCerrar && modal) {
        spanCerrar.onclick = function() {
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }
    }

    window.onclick = function(event) {
        if (modal && event.target == modal) {
            modal.style.display = "none";
            document.body.style.overflow = "auto";
        }
    }
});