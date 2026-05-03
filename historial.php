<?php
class Usuario {
    private PDO $conn;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function login(string $email, string $password): array|false {
        $email = trim($email);
        $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $stmtUpdate = $this->conn->prepare('UPDATE usuarios SET ultimo_acceso = CURRENT_TIMESTAMP WHERE id = ?');
            $stmtUpdate->execute([$user['id']]);
            return $user;
        }
        return false;
    }

    public function obtenerDatos(int $id): array|false {
        $stmt = $this->conn->prepare('SELECT * FROM usuarios WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function crearUsuario(string $nombre, string $email, string $password, int $rolId): bool {
        $nombre = trim($nombre);
        $email = trim($email);
        if ($nombre === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6 || !in_array($rolId, [1, 2], true)) {
            return false;
        }

        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare('INSERT INTO usuarios (nombre_completo, email, password, rol_id) VALUES (?, ?, ?, ?)');
            return $stmt->execute([$nombre, $email, $passwordHash, $rolId]);
        } catch (PDOException $e) {
            error_log('Error creando usuario: ' . $e->getMessage());
            return false;
        }
    }

    public function listarUsuarios(): array {
        $sql = 'SELECT u.id, u.nombre_completo, u.email, u.fecha_registro, u.ultimo_acceso, r.nombre AS rol_nombre
                FROM usuarios u
                JOIN roles r ON u.rol_id = r.id
                ORDER BY u.id DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function cambiarPassword(int $id, string $passwordActual, string $nuevaPassword): bool {
        if (strlen($nuevaPassword) < 6) {
            return false;
        }
        $user = $this->obtenerDatos($id);
        if ($user && password_verify($passwordActual, $user['password'])) {
            $hash = password_hash($nuevaPassword, PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare('UPDATE usuarios SET password = ? WHERE id = ?');
            return $stmt->execute([$hash, $id]);
        }
        return false;
    }

    public function eliminarUsuario(int $id): bool {
        if (isset($_SESSION['user']['id']) && $id === (int) $_SESSION['user']['id']) {
            return false;
        }
        $stmt = $this->conn->prepare('DELETE FROM usuarios WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public function cambiarRol(int $id, int $nuevoRol): bool {
        if (!in_array($nuevoRol, [1, 2], true)) {
            return false;
        }
        if (isset($_SESSION['user']['id']) && $id === (int) $_SESSION['user']['id']) {
            return false;
        }
        $stmt = $this->conn->prepare('UPDATE usuarios SET rol_id = ? WHERE id = ?');
        return $stmt->execute([$nuevoRol, $id]);
    }

    public function existeEmail(string $email): bool {
        $stmt = $this->conn->prepare('SELECT COUNT(*) FROM usuarios WHERE email = ?');
        $stmt->execute([trim($email)]);
        return (int) $stmt->fetchColumn() > 0;
    }
}
