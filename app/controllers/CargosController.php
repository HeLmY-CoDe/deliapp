<?php

class CargosController extends CargosModel
{
    private $CargosModel;

    public function __construct()
    {
        $this->CargosModel = new CargosModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerCargosTbody();

        $viewData = [
            'title'       => 'Cargos',
            'moduleTitle' => 'Cargos',
            'tbodyData'   => $tbodyData
        ];

        View::render('cargos', 'index', $viewData);
    }

    public function obtenerCargosTbody(): string
    {
        $cargos = $this->CargosModel->readAll();

        $cargosTbody = '';

        foreach ($cargos as $cargo) {

            $url = APP_URL . 'cargos/';

            $estadoIcon = ($cargo['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $cargosTbody .= "
            <tr>
                <td class='text-center'>{$cargo['id']}</td>
                <td class='text-center'>{$cargo['nombre']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon} fs-5\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$cargo['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$cargo['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $cargosTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre = $_POST['nombre'];
            $status = $_POST['status'];

            $createData  =  [
                'nombre' => $nombre,
                'status' => $status,
            ];

            $lastInsertId = $this->CargosModel->create($createData);

            Redirect::to(APP_URL . 'cargos', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Cargos',
            'formTitle' => 'Nuevo Cargo',
            'alertMsg'  => $alertMsg,
        ];

        View::render('cargos', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id  = htmlspecialchars($id);

        $cargo = $this->CargosModel->readById($id);

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id     = $_POST['id'];
            $nombre = $_POST['nombre'];
            $status = $_POST['status'];

            $updateData = [
                'id'     => $id,
                'nombre' => $nombre,
                'status' => $status,
            ];

            $rows = $this->CargosModel->update($updateData);

            Redirect::to(APP_URL . 'cargos', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        $viewData = [
            'title'     => 'Cargos',
            'formTitle' => 'Editar Cargo',
            'data'      => [
                'fetchData' => $cargo,
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('cargos', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->CargosModel->deleteById($id);

            Redirect::to(APP_URL . 'cargos', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Cargos',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }

    public function obtenerCargosOptions($usuarioCargoId = ''): string
    {
        $cargos = $this->CargosModel->readAllActive();

        $cargosOptions = '';

        foreach ($cargos as $cargo) {

            if (empty($usuarioCargoId)) {
                $cargosOptions .= "
                <option value=\"{$cargo['id']}\">{$cargo['nombre']}</option>
                ";
            } else {
                $selected = ($usuarioCargoId == $cargo['id'])
                    ? 'selected'
                    : '';

                $cargosOptions .= "
                <option value=\"{$cargo['id']}\" {$selected}>{$cargo['nombre']}</option>
                ";
            }
        }

        return $cargosOptions;
    }
}
