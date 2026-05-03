<?php 
$es_admin = (isset($_SESSION['rol']) && $_SESSION['rol'] == 1); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard principal de gestión de materiales e inventario del centro.">
    <meta name="keywords" content="inventario, administración, recursos, panel, BiblioTech">
    <title>BiblioTech - Panel de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>body { background-color: #f4f4f4; } .stat-card { border-left: 5px solid; }</style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid px-4">
        <a class="navbar-brand" href="index.php?action=dashboard"><i class="fas fa-desktop me-2"></i>BiblioTech</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3"><i class="fas fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['user']['nombre_completo'] ?? 'Usuario'); ?></span>
            <a href="index.php?action=perfil" class="btn btn-sm btn-secondary me-2">Perfil</a>
            <a href="index.php?action=logout" class="btn btn-sm btn-danger">Salir</a>
        </div>
    </div>
</nav>

<div class="container-fluid px-4">
    <?php if($es_admin): ?>
    <div class="d-flex justify-content-end gap-2 mb-3">
        <a href="index.php?action=panelUsuarios" class="btn btn-warning shadow-sm"><i class="fas fa-users-cog me-2"></i>Gestión de Usuarios</a>
        <a href="index.php?action=verHistorial" class="btn btn-danger shadow-sm"><i class="fas fa-trash-restore me-2"></i>Historial / Papelera</a>
    </div>
    <?php endif; ?>

    <div class="row mb-4 text-center">
        <?php 
        $t_disp = 0; $t_roto = 0; $t_ped = 0; $t_prestado = 0; $t_en_uso = 0;
        foreach($materiales as $m) {
            $t_disp += (int)$m['disponible'];
            $t_roto += (int)$m['roto'];
            $t_ped  += (int)$m['pedido'];
            $t_prestado += (int)$m['prestado'];
            $t_en_uso += (int)$m['en_uso'];
        }
        ?>
        <div class="col-md"><a href="index.php?action=detalles&estado=DISPONIBLE" class="text-decoration-none"><div class="card stat-card border-success mb-2"><div class="card-body py-2"><h6 class="text-success mb-1">Disponibles</h6><h3 class="text-dark m-0"><?php echo $t_disp; ?></h3></div></div></a></div>
        <div class="col-md"><a href="index.php?action=detalles&estado=ROTO" class="text-decoration-none"><div class="card stat-card border-danger mb-2"><div class="card-body py-2"><h6 class="text-danger mb-1">Rotos</h6><h3 class="text-dark m-0"><?php echo $t_roto; ?></h3></div></div></a></div>
        <div class="col-md"><a href="index.php?action=detalles&estado=PEDIDO" class="text-decoration-none"><div class="card stat-card border-warning mb-2"><div class="card-body py-2"><h6 class="text-warning mb-1">En Pedido</h6><h3 class="text-dark m-0"><?php echo $t_ped; ?></h3></div></div></a></div>
        <div class="col-md"><a href="index.php?action=detalles&estado=PRESTADO" class="text-decoration-none"><div class="card stat-card border-info mb-2"><div class="card-body py-2"><h6 class="text-info mb-1">Prestados</h6><h3 class="text-dark m-0"><?php echo $t_prestado; ?></h3></div></div></a></div>
        <div class="col-md"><a href="index.php?action=detalles&estado=EN_USO" class="text-decoration-none"><div class="card stat-card border-secondary mb-2"><div class="card-body py-2"><h6 class="text-secondary mb-1">En Aulas</h6><h3 class="text-dark m-0"><?php echo $t_en_uso; ?></h3></div></div></a></div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="m-0">Inventario General</h5>
            <?php if($es_admin): ?>
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalAdd">+ Añadir Material</button>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="mb-3"><input type="text" id="buscadorTabla" class="form-control" placeholder="Buscar material..."></div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha</th>
                            <th>Material</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <?php if($es_admin): ?><th>Opciones</th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($materiales as $m): ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?php echo isset($m['fecha_registro']) ? date('d/m/Y', strtotime($m['fecha_registro'])) : '-'; ?></div>
                                <div class="text-muted small"><i class="far fa-clock me-1"></i><?php echo isset($m['fecha_registro']) ? date('H:i', strtotime($m['fecha_registro'])) : ''; ?></div>
                            </td>
                            <td>
                                <strong><?php echo htmlspecialchars($m['nombre']); ?></strong><br>
                                <small class="text-muted d-block"><?php echo htmlspecialchars($m['descripcion']); ?></small>
                                
                                <div class="mt-1" style="font-size: 0.75rem;">
                                    <span class="text-muted">Añadido por: </span>
                                    <span class="fw-bold text-primary"><?php echo htmlspecialchars($m['usuario_alta'] ?? 'Antiguo'); ?></span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($m['nombre_categoria'] ?? 'General'); ?></td>
                            <td>
                                <?php if($m['disponible'] > 0): ?> <span class="badge bg-success">Disponible: <?php echo $m['disponible']; ?></span><br> <?php endif; ?>
                                <?php if($m['roto'] > 0): ?> <span class="badge bg-danger">Roto: <?php echo $m['roto']; ?></span><br> <?php endif; ?>
                                <?php if($m['pedido'] > 0): ?> <span class="badge bg-warning text-dark">En Pedido: <?php echo $m['pedido']; ?></span><br> <?php endif; ?>
                                <?php if($m['prestado'] > 0): ?> <span class="badge bg-info text-dark">Prestado: <?php echo $m['prestado']; ?></span><br> <?php endif; ?>
                                <?php if($m['en_uso'] > 0): ?> <span class="badge bg-secondary">En Aula: <?php echo $m['en_uso']; ?></span> <?php endif; ?>
                            </td>
                            <?php if($es_admin): ?>
                            <td><a href="index.php?action=eliminar&id=<?php echo $m['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres borrarlo?')">Eliminar</a></td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if($es_admin): ?>
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Añadir Activo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="index.php?action=guardar" method="POST">
                <div class="modal-body p-4">
                    <label class="small fw-bold">Nombre:</label>
                    <input type="text" name="nombre" class="form-control mb-2 shadow-sm" required>
                    
                    <label class="small fw-bold">Categoría:</label>
                    <select name="categoria_id" class="form-select mb-2 shadow-sm" required>
                        <option value="">Selecciona...</option>
                        <?php if(!empty($categorias)): foreach($categorias as $cat): ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nombre']); ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <label class="small fw-bold">Estado Inicial:</label>
                            <select name="estado" class="form-select shadow-sm">
                                <option value="DISPONIBLE">Disponible</option>
                                <option value="ROTO">Roto</option>
                                <option value="PEDIDO">Pedido (No recibido aún)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="small fw-bold">Cantidad:</label>
                            <input type="number" name="cantidad" class="form-control shadow-sm" value="1" min="1">
                        </div>
                    </div>
                    
                    <label class="small fw-bold mt-2">Descripción:</label>
                    <textarea name="descripcion" class="form-control shadow-sm" rows="2"></textarea>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="submit" class="btn btn-primary fw-bold px-4">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
    let buscador = document.getElementById('buscadorTabla');
    if(buscador) {
        buscador.addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('tbody tr');
            filas.forEach(function(fila) {
                let texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    }
</script>
</body>
</html>