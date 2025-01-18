<?php

class InventariosController extends InventariosModel
{
    private $InventariosModel;

    public function __construct()
    {
        $this->InventariosModel = new InventariosModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerInventariosTbody();

        $viewData = [
            'title'       => 'Inventarios',
            'moduleTitle' => 'Inventarios',
            'tbodyData'   => $tbodyData
        ];

        View::render('inventarios', 'index', $viewData);
    }

    public function obtenerInventariosTbody(): string
    {
        $inventarios = $this->InventariosModel->readAll();

        $inventariosTbody = '';

        foreach ($inventarios as $inventario) {

            $url = APP_URL . 'inventarios/';

            $estadoIcon = ($inventario['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $inventariosTbody .= "
            <tr>
                <td class='text-center'>{$inventario['id']}</td>
                <td class='text-center'>{$inventario['fecha']}</td>
                <td class='text-center'>{$inventario['usuario']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon} fs-5\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$inventario['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$inventario['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $inventariosTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        $ProductosController     = new ProductosController();
        $productosSeccionOptions = $ProductosController->obtenerProductosSeccionOptions(Session::getUserSeccion());

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $fecha      = $_POST['fecha'];
            $usuario_id = $_POST['usuario_id'];
            $status     = $_POST['status'];

            $createData  =  [
                'fecha'      => $fecha,
                'usuario_id' => $usuario_id,
                'status'     => $status,
            ];

            $lastInsertId = $this->InventariosModel->create($createData);

            Redirect::to(APP_URL . 'inventarios', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Inventarios',
            'formTitle' => 'Inventario Producto',
            'data'      => [
                'productosSeccionOptions' => $productosSeccionOptions,
            ],
            'alertMsg'  => $alertMsg,
        ];

        View::render('inventarios', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id  = htmlspecialchars($id);

        $inventario = $this->InventariosModel->readById($id);

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id         = $_POST['id'];
            $fecha      = $_POST['fecha'];
            $usuario_id = $_POST['usuario_id'];
            $status     = $_POST['status'];

            $updateData = [
                'id'         => $id,
                'fecha'      => $fecha,
                'usuario_id' => $usuario_id,
                'status'     => $status,
            ];

            $rows = $this->InventariosModel->update($updateData);

            Redirect::to(APP_URL . 'inventarios', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        $viewData = [
            'title'     => 'Inventarios',
            'formTitle' => 'Editar Inventario',
            'data'      => [
                'fetchData' => $inventario,
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('inventarios', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->InventariosModel->deleteById($id);

            Redirect::to(APP_URL . 'inventarios', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Inventarios',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }
}
