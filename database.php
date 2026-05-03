<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Recuperación de contraseña segura de BiblioTech. Restablece tus credenciales mediante tu correo electrónico corporativo asociado.">
    <meta name="keywords" content="recuperar contraseña, olvido de clave, restablecer acceso, soporte técnico, BiblioTech">
    <meta name="robots" content="noindex, follow">
    <title>Recuperar Contraseña - BiblioTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow border-0" style="width: 100%; max-width: 450px; border-radius: 12px;">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width: 70px; height: 70px;">
                    <i class="fas fa-key fs-1"></i>
                </div>
                <h3 class="fw-bold text-dark">Recuperar Acceso</h3>
                <p class="text-muted small">Introduce tu correo corporativo y te enviaremos instrucciones para restablecer tu contraseña.</p>
            </div>

            <?php if(isset($_GET['status']) && $_GET['status'] == 'sent'): ?>
                <div class="alert alert-success small text-center shadow-sm">
                    <i class="fas fa-paper-plane me-1"></i> Si el correo existe en nuestro sistema, hemos enviado un enlace de recuperación.
                </div>
                <a href="index.php?action=login" class="btn btn-outline-primary w-100 fw-bold mt-2">Volver al Inicio</a>
            <?php else: ?>
                <form action="index.php?action=procesar_recuperar" method="POST">
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">CORREO ELECTRÓNICO REGISTRADO</label>
                        <input type="email" name="email_recuperacion" class="form-control py-2 bg-light" required placeholder="Ej: empleado@bibliotech.com">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2 shadow-sm">
                        <i class="fas fa-envelope me-2"></i>Enviar Enlace
                    </button>
                </form>
                <div class="text-center mt-4">
                    <a href="index.php?action=login" class="text-decoration-none text-muted small hover-primary">
                        <i class="fas fa-arrow-left me-1"></i> Volver a la pantalla de acceso
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>