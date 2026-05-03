<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Acceso seguro al panel de gestión integral de inventario BiblioTech. Inicia sesión con tus credenciales corporativas.">
    <meta name="keywords" content="iniciar sesión, login, acceso seguro, credenciales, BiblioTech, gestión de inventario">
    <meta name="robots" content="index, follow">
    <title>Acceso Seguro - BiblioTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg border-0" style="width: 100%; max-width: 420px; border-radius: 15px;">
        <div class="card-header bg-primary text-white text-center py-4" style="border-radius: 15px 15px 0 0;">
            <h3 class="mb-0 fw-bold"><i class="fas fa-desktop me-2"></i>BiblioTech</h3>
            <small class="text-light opacity-75">Gestión Inteligente de Inventario</small>
        </div>
        <div class="card-body p-4">
            
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger shadow-sm py-2"><i class="fas fa-exclamation-circle me-2"></i>Usuario o contraseña incorrectos.</div>
            <?php endif; ?>

            <form action="index.php?action=procesar_login" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold text-muted small">CORREO INSTITUCIONAL</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-primary"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control bg-light" required placeholder="tu@correo.com">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small">CONTRASEÑA</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-primary"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control bg-light" required placeholder="••••••••">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm fs-5">
                    <i class="fas fa-sign-in-alt me-2"></i>Entrar al Sistema
                </button>
            </form>
            
            <div class="text-center mt-4 pt-3 border-top">
                <a href="index.php?action=recuperar" class="text-decoration-none text-primary fw-medium small">
                    <i class="fas fa-question-circle me-1"></i> ¿Has olvidado tu contraseña?
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>