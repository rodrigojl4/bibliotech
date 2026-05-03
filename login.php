<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles - <?php echo htmlspecialchars($estado); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: #f8f9fc; font-family: 'Segoe UI', sans-serif; }
        .navbar { background: linear-gradient(135deg, #4e73df 0%, #224abe 100%); }
        .category-header { background: #f8f9fc; color: #4e73df; font-weight: bold; padding: 10px 15px; margin-top: 25px; border-radius: 8px; font-size: 0.95rem; }
        .table td, .table th { vertical-align: middle; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark py-3 mb-4 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php?action=dashboard">
            <i class="fas fa-arrow-left me-2"></i> Volver al Panel
        </a>
        <span class="text-white fw-bold badge bg-dark bg-opacity-25 px-3 py-2 border">
            Listado de estado: <?php echo htmlspecialchars($estado); ?>
        </span>
    </div>
</nav>

<div class="container pb-5">
    <div class="card border-0 shadow-sm p-4">
        <?php if(empty($items)): ?>
            <h3 class="fw-bold mb-4">Materiales: <span class="text-primary"><?php echo htmlspecialchars($estado); ?></span></h3>
            <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i> No se encontraron materiales registrados en este estado.</div>
        <?php else: ?>
            <?php
            $agrupados = [];
            foreach($items as $item) {
                $categoria = $item['categoria'] ?? 'Sin categoría';
                $agrupados[$categoria][] = $item;
            }
            ?>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
                <h3 class="fw-bold m-0">Materiales: <span class="text-primary"><?php echo htmlspecialchars($estado); ?></span></h3>
                <input type="text" id="buscadorDetalles" class="form-control shadow-sm" placeholder="Buscar por nombre, serial, aula o persona..." style="max-width: 360px;">
            </div>

            <form id="formMasivo" method="POST" action="index.php?action=accion_masiva">
                <?php foreach($agrupados as $categoria => $listaMateriales): ?>
                    <h5 class="category-header"><i class="fas fa-folder-open me-2"></i><?php echo htmlspecialchars($categoria); ?></h5>
                    <div class="table-responsive mb-3">
                        <table class="table table-hover align-middle bg-white border rounded shadow-sm">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 45px;"><input type="checkbox" class="form-check-input" onclick="toggleSelectAll(this)"></th>
                                    <th>Serial</th>
                                    <th>Nombre</th>
                                    <?php if($estado == 'PRESTADO'): ?>
                                        <th>Prestado a</th>
                                        <th>Fecha límite</th>
                                    <?php elseif($estado == 'EN_USO'): ?>
                                        <th>Ubicación actual</th>
                                    <?php else: ?>
                                        <th>Descripción</th>
                                        <th>Fecha de alta</th>
                                    <?php endif; ?>
                                    <th class="text-end" style="min-width: 300px;">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <select name="accion_masiva" class="form-select form-select-sm border-secondary shadow-sm" required style="width: 150px; cursor: pointer;">
                                                <option value="" disabled selected>Mover a...</option>
                                                <option value="DISPONIBLE">Disponible</option>
                                                <option value="ROTO">Roto / Retirar</option>
                                                <option value="PEDIDO">En Pedido</option>
                                            </select>
                                            <button type="button" class="btn btn-sm btn-primary ms-2 shadow-sm" onclick="ejecutarAccionMasiva(this)">Aplicar</button>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaMateriales as $mat): ?>
                                <tr class="fila-material">
                                    <td class="text-center"><input class="form-check-input item-checkbox border-secondary" type="checkbox" value="<?php echo htmlspecialchars($mat['codigo_serial']); ?>"></td>
                                    <td class="text-muted small"><i class="fas fa-barcode me-1"></i><?php echo htmlspecialchars($mat['codigo_serial']); ?></td>
                                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($mat['nombre']); ?></td>

                                    <?php if($estado == 'PRESTADO'): ?>
                                        <td class="fw-bold"><?php echo htmlspecialchars($mat['prestado_a']); ?></td>
                                        <td>
                                            <?php $retraso = !empty($mat['fecha_limite']) && $mat['fecha_limite'] < date('Y-m-d'); ?>
                                            <span class="badge <?php echo $retraso ? 'bg-danger' : 'bg-success'; ?> px-2 py-1">
                                                <?php echo !empty($mat['fecha_limite']) ? date('d/m/Y', strtotime($mat['fecha_limite'])) : '-'; ?>
                                                <?php if($retraso) echo ' (Retrasado)'; ?>
                                            </span>
                                        </td>
                                    <?php elseif($estado == 'EN_USO'): ?>
                                        <td class="fw-bold text-secondary"><i class="fas fa-door-open me-2"></i><?php echo htmlspecialchars($mat['ubicacion'] ?? 'Sin aula'); ?></td>
                                    <?php else: ?>
                                        <td class="small text-muted"><?php echo htmlspecialchars($mat['descripcion'] ?? ''); ?></td>
                                        <td class="small"><i class="far fa-calendar me-1"></i><?php echo !empty($mat['fecha_registro']) ? date('d/m/Y', strtotime($mat['fecha_registro'])) : '-'; ?></td>
                                    <?php endif; ?>

                                    <td class="text-end">
                                        <?php if($estado == 'DISPONIBLE'): ?>
                                            <div class="d-flex flex-column align-items-end gap-1">
                                                <div class="d-flex m-0">
                                                    <input type="text" id="prestado_a_<?php echo htmlspecialchars($mat['codigo_serial']); ?>" class="form-control form-control-sm me-1 shadow-sm" placeholder="Persona..." style="max-width: 120px;">
                                                    <input type="date" id="fecha_limite_<?php echo htmlspecialchars($mat['codigo_serial']); ?>" class="form-control form-control-sm me-1 shadow-sm" style="max-width: 120px;">
                                                    <button type="button" class="btn btn-sm btn-info text-white shadow-sm" onclick="ejecutarIndividual('prestar', '<?php echo htmlspecialchars($mat['codigo_serial']); ?>')">Prestar</button>
                                                </div>
                                                <div class="d-flex m-0 w-100 justify-content-end">
                                                    <select id="aula_<?php echo htmlspecialchars($mat['codigo_serial']); ?>" class="form-select form-select-sm me-1 shadow-sm" style="max-width: 245px;" required>
                                                        <option value="" selected disabled>Selecciona aula...</option>
                                                        <?php foreach($aulas as $aula): ?>
                                                            <option value="<?php echo (int) $aula['id']; ?>"><?php echo htmlspecialchars($aula['nombre']); ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <button type="button" class="btn btn-sm btn-secondary shadow-sm" style="width: 73px;" onclick="ejecutarIndividual('asignar_uso', '<?php echo htmlspecialchars($mat['codigo_serial']); ?>')">Fijar</button>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <select id="estado_<?php echo htmlspecialchars($mat['codigo_serial']); ?>" class="form-select form-select-sm border-2 shadow-sm ms-auto" onchange="ejecutarIndividual('cambiar_estado', '<?php echo htmlspecialchars($mat['codigo_serial']); ?>')" style="max-width: 180px;">
                                                <option value="" disabled selected>Mover a...</option>
                                                <?php if($estado == 'PRESTADO' || $estado == 'EN_USO'): ?>
                                                    <option value="DISPONIBLE">Devolver al almacén</option>
                                                    <option value="ROTO">Retirar (Roto)</option>
                                                <?php else: ?>
                                                    <option value="DISPONIBLE">Disponible</option>
                                                    <option value="ROTO">Roto / Averiado</option>
                                                    <option value="PEDIDO">En Pedido</option>
                                                <?php endif; ?>
                                            </select>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </form>

            <form id="formIndividual" method="POST" style="display: none;">
                <input type="hidden" name="codigo_serial" id="ind_serial">
                <input type="hidden" name="prestado_a" id="ind_persona">
                <input type="hidden" name="fecha_limite" id="ind_fecha">
                <input type="hidden" name="aula_id" id="ind_aula_id">
                <input type="hidden" name="nuevo_estado" id="ind_estado">
            </form>
        <?php endif; ?>
    </div>
</div>

<script>
    const inputBuscador = document.getElementById('buscadorDetalles');
    if (inputBuscador) {
        inputBuscador.addEventListener('keyup', function() {
            const filtro = this.value.toLowerCase();
            document.querySelectorAll('.table-responsive').forEach(function(contenedor) {
                const filas = contenedor.querySelectorAll('tbody tr.fila-material');
                const tituloCategoria = contenedor.previousElementSibling;
                let filasVisibles = 0;
                filas.forEach(function(fila) {
                    const visible = fila.innerText.toLowerCase().includes(filtro);
                    fila.style.display = visible ? '' : 'none';
                    if (visible) filasVisibles++;
                });
                contenedor.style.display = filasVisibles === 0 ? 'none' : '';
                if (tituloCategoria && tituloCategoria.tagName === 'H5') tituloCategoria.style.display = filasVisibles === 0 ? 'none' : '';
            });
        });
    }

    function toggleSelectAll(source) {
        const table = source.closest('table');
        table.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = source.checked);
    }

    function ejecutarAccionMasiva(btn) {
        const table = btn.closest('table');
        const seleccionados = table.querySelectorAll('.item-checkbox:checked');
        const selectAccion = table.querySelector('select[name="accion_masiva"]').value;
        if (seleccionados.length === 0) { alert('Selecciona al menos un material.'); return; }
        if (selectAccion === '') { alert('Elige una acción.'); return; }
        if (confirm('¿Seguro que quieres aplicar el cambio a los ' + seleccionados.length + ' elementos seleccionados?')) {
            const form = document.getElementById('formMasivo');
            let mainSelect = form.querySelector('input[name="accion_masiva"]');
            if (!mainSelect) {
                mainSelect = document.createElement('input');
                mainSelect.type = 'hidden';
                mainSelect.name = 'accion_masiva';
                form.appendChild(mainSelect);
            }
            mainSelect.value = selectAccion;
            seleccionados.forEach(cb => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'seriales[]';
                input.value = cb.value;
                form.appendChild(input);
            });
            form.submit();
        }
    }

    function ejecutarIndividual(accion, serial) {
        const form = document.getElementById('formIndividual');
        form.action = 'index.php?action=' + (accion === 'cambiar_estado' ? 'cambiarEstado' : accion);
        document.getElementById('ind_serial').value = serial;
        if (accion === 'prestar') {
            const persona = document.getElementById('prestado_a_' + serial).value.trim();
            const fecha = document.getElementById('fecha_limite_' + serial).value;
            if (!persona || !fecha) { alert('Rellena persona y fecha para prestar.'); return; }
            document.getElementById('ind_persona').value = persona;
            document.getElementById('ind_fecha').value = fecha;
        } else if (accion === 'asignar_uso') {
            const aulaId = document.getElementById('aula_' + serial).value;
            if (!aulaId) { alert('Selecciona un aula válida antes de fijar el material.'); return; }
            document.getElementById('ind_aula_id').value = aulaId;
        } else if (accion === 'cambiar_estado') {
            const estado = document.getElementById('estado_' + serial).value;
            if (!estado) return;
            document.getElementById('ind_estado').value = estado;
        }
        form.submit();
    }
</script>
</body>
</html>
