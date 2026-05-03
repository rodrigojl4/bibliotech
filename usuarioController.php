<?php
require_once 'models/material.php';

class MaterialController {
    private PDO $db;
    private Material $model;

    public function __construct(PDO $db) {
        $this->db = $db;
        $this->model = new Material($this->db);
    }

    private function esAdmin(): bool {
        return isset($_SESSION['rol']) && (int) $_SESSION['rol'] === 1;
    }

    private function redirigir(string $url = 'index.php?action=dashboard'): void {
        header('Location: ' . $url);
        exit();
    }

    private function volver(): void {
        $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php?action=dashboard';
        $this->redirigir($referer);
    }

    public function dashboard(): void {
        $materiales = $this->model->listarTodo();
        $categorias = $this->model->obtenerCategorias();
        include 'views/inventario.php';
    }

    public function guardar(): void {
        if ($this->esAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->crear(
                $_POST['nombre'] ?? '',
                $_POST['descripcion'] ?? '',
                (int) ($_POST['categoria_id'] ?? 0),
                $_POST['estado'] ?? 'DISPONIBLE',
                (int) ($_POST['cantidad'] ?? 1)
            );
        }
        $this->redirigir();
    }

    public function borrar(): void {
        if ($this->esAdmin() && isset($_GET['id'])) {
            $this->model->eliminar((int) $_GET['id']);
        }
        $this->redirigir();
    }

    public function verHistorial(): void {
        if (!$this->esAdmin()) {
            $this->redirigir();
        }
        $materialesBorrados = $this->model->listarBorrados();
        include 'views/historial.php';
    }

    public function detalles(): void {
        $estado = $_GET['estado'] ?? 'DISPONIBLE';
        $items = $this->model->listarPorEstado($estado);
        $aulas = $this->model->obtenerAulas();
        include 'views/detalles.php';
    }

    public function accionMasiva(): void {
        if ($this->esAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $seriales = $_POST['seriales'] ?? [];
            $accion = $_POST['accion_masiva'] ?? '';
            if (is_array($seriales) && $accion !== '') {
                foreach ($seriales as $serial) {
                    $this->model->actualizarEstado((string) $serial, $accion);
                }
            }
        }
        $this->volver();
    }

    public function cambiarEstado(): void {
        if ($this->esAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->actualizarEstado($_POST['codigo_serial'] ?? '', $_POST['nuevo_estado'] ?? '');
        }
        $this->volver();
    }

    public function prestar(): void {
        if ($this->esAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->prestarMaterial($_POST['codigo_serial'] ?? '', $_POST['prestado_a'] ?? '', $_POST['fecha_limite'] ?? '');
        }
        $this->volver();
    }

    public function asignarUso(): void {
        if ($this->esAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->asignarUso($_POST['codigo_serial'] ?? '', (int) ($_POST['aula_id'] ?? 0));
        }
        $this->volver();
    }

    public function restaurar(): void {
        if ($this->esAdmin() && isset($_GET['id'])) {
            $this->model->restaurar((int) $_GET['id']);
        }
        $this->redirigir('index.php?action=verHistorial');
    }
}
