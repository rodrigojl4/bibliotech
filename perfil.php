<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Registro histórico y recuperación de activos dados de baja en la plataforma.">
    <meta name="keywords" content="registro, papelera, activos, recuperación, auditoría">
    <title>Registro de Bajas - BiblioTech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { background: #f8f9fc; font-family: 'Segoe UI', sans-serif; }</style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="index.php?action=dashboard"><i class="fas fa-desktop me-2"></i>BiblioTech</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-danger"><i class="fas fa-trash-alt me-2"></i>Registro de Materiales Eliminados</h2>
        <a href="index.php?action=dashboard" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al Inventario</a>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <?php if(empty($materialesBorrados)): ?>
            <div class="alert alert-success">No existen registros en la base de datos de bajas.</div>
        <?php else: ?>
            <div class="table-responsive bg-white rounded shadow-sm p-3">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Denominación</th>
                            <th>Clasificación</th>
                            <th>Alta Inicial</th>
                            <th class="text-danger">Fecha de Eliminación</th>
                            <th>Gestión</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($materialesBorrados as $m): ?>
                        <tr>
                            <td><?php echo $m['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($m['nombre']); ?></strong></td>
                            <td><?php echo htmlspecialchars($m['nombre_categoria']); ?></td>
                            <td class="small"><?php echo date('d/m/Y', strtotime($m['fecha_registro'])); ?></td>
                            
                            <td class="text-danger fw-bold small">
                                <i class="fas fa-calendar-times me-1"></i>
                                <?php echo $m['fecha_baja'] ? date('d/m/Y H:i', strtotime($m['fecha_baja'])) : 'N/A'; ?>
                            </td>

                            <td>
                                <a href="index.php?action=restaurar&id=<?php echo $m['id']; ?>" 
                                class="btn btn-sm btn-success shadow-sm"
                                onclick="return confirm('¿Reactivar este material en el inventario activo?')">
                                    <i class="fas fa-undo me-1"></i> Reactivar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    function restaurarMaterial(id) {
        let confirmar = confirm('¿Proceder con la reactivación de este activo en el sistema?');
        if (confirmar) {
            window.location.href = 'index.php?action=restaurar&id=' + id;
        }
    }
</script>
</body>
</html>