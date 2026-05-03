<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Perfil de usuario en BiblioTech. Visualiza tus datos corporativos, revisa tu último acceso y gestiona la seguridad de tu cuenta modificando tu clave personal.">
    <meta name="keywords" content="perfil de usuario, cuenta personal, cambiar contraseña, seguridad, BiblioTech, panel de empleado">
    <meta name="robots" content="noindex, nofollow">
    <title>Mi Perfil y Seguridad - BiblioTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary mb-4 shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php?action=dashboard">
            <i class="fas fa-arrow-left me-2"></i> Volver al Inventario
        </a>
    </div>
</nav>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'pwd_ok'): ?>
                <div class="alert alert-success shadow-sm"><i class="fas fa-check-circle me-2"></i> Tu contraseña se ha actualizado correctamente.</div>
            <?php elseif(isset($_GET['msg']) && $_GET['msg'] == 'pwd_error'): ?>
                <div class="alert alert-danger shadow-sm"><i class="fas fa-times-circle me-2"></i> Error: La contraseña actual introducida no es correcta.</div>
            <?php endif; ?>

            <div class="card shadow border-0 rounded-3">
                <div class="card-body p-4 p-md-5">
                    
                    <?php 
                    $nombre = htmlspecialchars($datosUsuario['nombre_completo']);
                    $iniciales = strtoupper(substr($nombre, 0, 2)); 
                    ?>
                    
                    <div class="d-flex align-items-center border-bottom pb-4 mb-4">
                        <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center fs-2 fw-bold me-4 shadow-sm" style="width: 90px; height: 90px;">
                            <?php echo $iniciales; ?>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-1 text-dark"><?php echo $nombre; ?></h2>
                            <p class="text-muted mb-0 fs-5"><i class="fas fa-envelope me-2"></i><?php echo htmlspecialchars($datosUsuario['email']); ?></p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-sm-6 mb-4">
                            <span class="text-muted small fw-bold tracking-wide">NIVEL DE ACCESO</span>
                            <p class="fs-5 mb-0 text-dark"><?php echo ($_SESSION['rol'] == 1) ? 'Administrador' : 'Usuario Estándar'; ?></p>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <span class="text-muted small fw-bold tracking-wide">ÚLTIMO ACCESO</span>
                            <p class="fs-5 mb-0 text-dark">
                                <i class="far fa-clock me-1 text-muted"></i> 
                                <?php echo $datosUsuario['ultimo_acceso'] ? date('d/m/Y H:i', strtotime($datosUsuario['ultimo_acceso'])) : 'Primera sesión'; ?>
                            </p>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4 pt-3 border-top">
                        <!-- Botón que abre el modal -->
                        <button type="button" class="btn btn-outline-primary px-4 me-md-2 fw-bold" data-bs-toggle="modal" data-bs-target="#modalPassword">
                            <i class="fas fa-key me-2"></i>Cambiar Contraseña
                        </button>
                        <a href="index.php?action=logout" class="btn btn-danger px-4 fw-bold">
                            <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Cambiar Contraseña -->
<div class="modal fade" id="modalPassword" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold"><i class="fas fa-lock me-2"></i>Actualizar Contraseña</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?action=actualizar_password" method="POST" id="formPwd">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold">Contraseña Actual:</label>
                        <input type="password" name="password_actual" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold">Nueva Contraseña:</label>
                        <input type="password" id="pwd_nueva" name="password_nueva" class="form-control" minlength="6" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold">Repetir Nueva Contraseña:</label>
                        <input type="password" id="pwd_repetir" class="form-control" minlength="6" required>
                    </div>
                    <div id="error_pwd" class="text-danger small" style="display:none;"><i class="fas fa-exclamation-triangle me-1"></i> Las contraseñas nuevas no coinciden.</div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary fw-bold" onclick="validarPassword()">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validarPassword() {
        let nueva = document.getElementById('pwd_nueva').value;
        let repetir = document.getElementById('pwd_repetir').value;
        let msjError = document.getElementById('error_pwd');
        
        if (nueva !== repetir || nueva === '') {
            msjError.style.display = 'block';
        } else {
            msjError.style.display = 'none';
            document.getElementById('formPwd').submit();
        }
    }
</script>
</body>
</html>