<?php
require_once 'models/usuario.php';

class UsuarioController {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function esAdmin(): bool {
        return isset($_SESSION['rol']) && (int) $_SESSION['rol'] === 1;
    }

    private function redirigir(string $url): void {
        header('Location: ' . $url);
        exit();
    }

    public function mostrarLogin(): void {
        if (isset($_SESSION['user'])) {
            $this->redirigir('index.php?action=dashboard');
        }
        include 'views/login.php';
    }

    public function procesarLogin(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['email']) && !empty($_POST['password'])) {
            $model = new Usuario($this->db);
            $user = $model->login($_POST['email'], $_POST['password']);

            if ($user) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => (int) $user['id'],
                    'nombre_completo' => $user['nombre_completo'],
                    'email' => $user['email'],
                    'cargo' => $user['cargo'] ?? 'Usuario',
                    'rol_id' => (int) $user['rol_id']
                ];
                $_SESSION['rol'] = (int) $user['rol_id'];
                $this->redirigir('index.php?action=dashboard');
            }
        }
        $this->redirigir('index.php?action=login&error=1');
    }

    public function mostrarRecuperar(): void {
        include 'views/recuperar.php';
    }

    public function procesarRecuperar(): void {
        // Pantalla preparada para futuras integraciones con PHPMailer/tokens.
        // Por seguridad no se informa si el correo existe o no.
        $this->redirigir('index.php?action=recuperar&status=sent');
    }

    public function perfil(): void {
        if (!isset($_SESSION['user'])) {
            $this->redirigir('index.php?action=login');
        }
        $model = new Usuario($this->db);
        $datosUsuario = $model->obtenerDatos((int) $_SESSION['user']['id']);
        include 'views/perfil.php';
    }

    public function logout(): void {
        $_SESSION = [];
        session_destroy();
        $this->redirigir('index.php?action=login');
    }

    public function panelUsuarios(): void {
        if (!$this->esAdmin()) {
            $this->redirigir('index.php?action=dashboard');
        }
        $model = new Usuario($this->db);
        $listaUsuarios = $model->listarUsuarios();
        include 'views/usuarios.php';
    }

    public function guardarUsuario(): void {
        if ($this->esAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Usuario($this->db);
            $model->crearUsuario(
                $_POST['nombre_completo'] ?? '',
                $_POST['email'] ?? '',
                $_POST['password'] ?? '',
                (int) ($_POST['rol_id'] ?? 2)
            );
        }
        $this->redirigir('index.php?action=panelUsuarios');
    }

    public function actualizarPassword(): void {
        if (isset($_SESSION['user']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Usuario($this->db);
            $ok = $model->cambiarPassword(
                (int) $_SESSION['user']['id'],
                $_POST['password_actual'] ?? '',
                $_POST['password_nueva'] ?? ''
            );
            $this->redirigir('index.php?action=perfil&msg=' . ($ok ? 'pwd_ok' : 'pwd_error'));
        }
        $this->redirigir('index.php?action=perfil');
    }

    public function borrarUsuario(): void {
        if ($this->esAdmin() && isset($_GET['id'])) {
            $model = new Usuario($this->db);
            $model->eliminarUsuario((int) $_GET['id']);
        }
        $this->redirigir('index.php?action=panelUsuarios');
    }

    public function editarRol(): void {
        if ($this->esAdmin() && isset($_GET['id'], $_GET['rol'])) {
            $model = new Usuario($this->db);
            $model->cambiarRol((int) $_GET['id'], (int) $_GET['rol']);
        }
        $this->redirigir('index.php?action=panelUsuarios');
    }
}
