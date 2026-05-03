<?php
class Material {
    private PDO $conn;
    private array $estadosPermitidos = ['DISPONIBLE', 'ROTO', 'PEDIDO', 'PRESTADO', 'EN_USO'];

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function registrarAuditoria(string $accion): bool {
        $usuario = $_SESSION['user']['nombre_completo'] ?? 'Sistema';
        $stmt = $this->conn->prepare('INSERT INTO auditoria (usuario, accion, fecha) VALUES (?, ?, NOW())');
        return $stmt->execute([$usuario, $accion]);
    }

    public function listarTodo(): array {
        $query = "SELECT m.*, c.nombre AS nombre_categoria,
                  SUM(CASE WHEN i.estado = 'DISPONIBLE' THEN 1 ELSE 0 END) AS disponible,
                  SUM(CASE WHEN i.estado = 'ROTO' THEN 1 ELSE 0 END) AS roto,
                  SUM(CASE WHEN i.estado = 'PEDIDO' THEN 1 ELSE 0 END) AS pedido,
                  SUM(CASE WHEN i.estado = 'PRESTADO' THEN 1 ELSE 0 END) AS prestado,
                  SUM(CASE WHEN i.estado = 'EN_USO' THEN 1 ELSE 0 END) AS en_uso
                  FROM materiales m
                  LEFT JOIN categorias c ON m.categoria_id = c.id
                  LEFT JOIN items_fisicos i ON i.material_id = m.id
                  WHERE m.activo = 1
                  GROUP BY m.id, c.nombre
                  ORDER BY m.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function crear(string $nom, ?string $des, int $cat, string $estadoInicial, int $cantidad = 1): bool {
        $nom = trim($nom);
        $des = trim((string) $des);
        $cantidad = max(1, min(100, $cantidad));

        if ($nom === '' || !in_array($estadoInicial, $this->estadosPermitidos, true)) {
            return false;
        }

        $this->conn->beginTransaction();
        try {
            $autor = $_SESSION['user']['nombre_completo'] ?? 'Sistema';
            $stmt = $this->conn->prepare('INSERT INTO materiales (nombre, descripcion, categoria_id, usuario_alta, activo, fecha_registro) VALUES (?, ?, ?, ?, 1, NOW())');
            $stmt->execute([$nom, $des, $cat, $autor]);
            $materialId = (int) $this->conn->lastInsertId();

            $stmtItem = $this->conn->prepare('INSERT INTO items_fisicos (material_id, estado, codigo_serial) VALUES (?, ?, ?)');
            for ($i = 0; $i < $cantidad; $i++) {
                $stmtItem->execute([$materialId, $estadoInicial, $this->generarSerialUnico()]);
            }

            $this->registrarAuditoria("Añadió {$cantidad} unidad(es) de '{$nom}' en estado '{$estadoInicial}'.");
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            error_log('Error creando material: ' . $e->getMessage());
            return false;
        }
    }

    private function generarSerialUnico(): string {
        do {
            $serial = 'SN-' . strtoupper(bin2hex(random_bytes(3))) . '-' . random_int(1000, 9999);
            $stmt = $this->conn->prepare('SELECT COUNT(*) FROM items_fisicos WHERE codigo_serial = ?');
            $stmt->execute([$serial]);
        } while ((int) $stmt->fetchColumn() > 0);
        return $serial;
    }

    public function actualizarEstado(string $serial, string $estado): bool {
        if (!in_array($estado, $this->estadosPermitidos, true)) {
            return false;
        }
        $stmt = $this->conn->prepare('UPDATE items_fisicos SET estado = ?, prestado_a = NULL, fecha_limite = NULL, ubicacion = NULL, aula_id = NULL WHERE codigo_serial = ?');
        $ok = $stmt->execute([$estado, $serial]);
        if ($ok) {
            $this->registrarAuditoria("Cambió serial {$serial} a '{$estado}'.");
        }
        return $ok;
    }

    public function eliminar(int $id): bool {
        $stmt = $this->conn->prepare('UPDATE materiales SET activo = 0, fecha_baja = NOW() WHERE id = ?');
        $ok = $stmt->execute([$id]);
        if ($ok) {
            $this->registrarAuditoria("Eliminó material ID: {$id}");
        }
        return $ok;
    }

    public function restaurar(int $id): bool {
        $stmt = $this->conn->prepare('UPDATE materiales SET activo = 1, fecha_baja = NULL WHERE id = ?');
        $ok = $stmt->execute([$id]);
        if ($ok) {
            $this->registrarAuditoria("Reactivó el material ID: {$id}");
        }
        return $ok;
    }

    public function listarPorEstado(string $estado): array {
        if (!in_array($estado, $this->estadosPermitidos, true)) {
            return [];
        }
        $query = "SELECT m.nombre, m.descripcion, m.fecha_registro, c.nombre AS categoria,
                         i.codigo_serial, i.estado, i.prestado_a, i.fecha_limite,
                         COALESCE(a.nombre, i.ubicacion) AS ubicacion, i.aula_id
                  FROM items_fisicos i
                  JOIN materiales m ON i.material_id = m.id
                  LEFT JOIN categorias c ON m.categoria_id = c.id
                  LEFT JOIN aulas a ON i.aula_id = a.id
                  WHERE i.estado = ? AND m.activo = 1
                  ORDER BY c.nombre ASC, m.nombre ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$estado]);
        return $stmt->fetchAll();
    }

    public function obtenerCategorias(): array {
        return $this->conn->query('SELECT * FROM categorias ORDER BY nombre ASC')->fetchAll();
    }

    public function prestarMaterial(string $serial, string $persona, string $fecha): bool {
        $persona = trim($persona);
        if ($persona === '' || !$this->fechaValida($fecha)) {
            return false;
        }
        $stmt = $this->conn->prepare("UPDATE items_fisicos SET estado = 'PRESTADO', prestado_a = ?, fecha_limite = ?, ubicacion = NULL, aula_id = NULL WHERE codigo_serial = ? AND estado = 'DISPONIBLE'");
        $ok = $stmt->execute([$persona, $fecha, $serial]);
        if ($ok && $stmt->rowCount() > 0) {
            $this->registrarAuditoria("Prestó {$serial} a {$persona} hasta {$fecha}.");
            return true;
        }
        return false;
    }

    public function obtenerAulas(): array {
        $stmt = $this->conn->query('SELECT id, nombre FROM aulas ORDER BY nombre ASC');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function obtenerNombreAula(int $aulaId): ?string {
        $stmt = $this->conn->prepare('SELECT nombre FROM aulas WHERE id = ?');
        $stmt->execute([$aulaId]);
        $nombre = $stmt->fetchColumn();
        return $nombre !== false ? (string) $nombre : null;
    }

    public function asignarUso(string $serial, int $aulaId): bool {
        if ($aulaId <= 0) {
            return false;
        }

        $nombreAula = $this->obtenerNombreAula($aulaId);
        if ($nombreAula === null) {
            return false;
        }

        $stmt = $this->conn->prepare("UPDATE items_fisicos SET estado = 'EN_USO', aula_id = ?, ubicacion = ?, prestado_a = NULL, fecha_limite = NULL WHERE codigo_serial = ? AND estado = 'DISPONIBLE'");
        $ok = $stmt->execute([$aulaId, $nombreAula, $serial]);
        if ($ok && $stmt->rowCount() > 0) {
            $this->registrarAuditoria("Asignó {$serial} al aula {$nombreAula}.");
            return true;
        }
        return false;
    }

    private function fechaValida(string $fecha): bool {
        $d = DateTime::createFromFormat('Y-m-d', $fecha);
        return $d && $d->format('Y-m-d') === $fecha;
    }

    public function listarBorrados(): array {
        return $this->conn->query("SELECT m.*, c.nombre AS nombre_categoria FROM materiales m LEFT JOIN categorias c ON m.categoria_id = c.id WHERE m.activo = 0 ORDER BY m.fecha_baja DESC")->fetchAll();
    }
}
