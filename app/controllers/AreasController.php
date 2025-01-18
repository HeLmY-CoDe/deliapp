<?php

class AreasController extends AreasModel
{
    private $AreasModel;

    public function __construct()
    {
        $this->AreasModel = new AreasModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerAreasTbody();

        $viewData = [
            'title'       => 'Áreas',
            'moduleTitle' => 'Áreas',
            'tbodyData'   => $tbodyData
        ];

        View::render('areas', 'index', $viewData);
    }

    public function obtenerAreasTbody(): string
    {
        $areas = $this->AreasModel->readAll();

        $areasTbody = '';

        foreach ($areas as $area) {

            $url = APP_URL . 'areas/';

            $estadoIcon = ($area['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $areasTbody .= "
            <tr>
                <td class='text-center'>{$area['id']}</td>
                <td class='text-center'>{$area['nombre']}</td>
                <td class='text-center'>{$area['descripcion']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon} fs-5\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$area['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$area['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $areasTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre      = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $status      = $_POST['status'];

            $createData  =  [
                'nombre'      => $nombre,
                'descripcion' => $descripcion,
                'status'      => $status,
            ];

            $lastInsertId = $this->AreasModel->create($createData);

            Redirect::to(APP_URL . 'areas', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Áreas',
            'formTitle' => 'Nueva Área',
            'alertMsg'  => $alertMsg,
        ];

        View::render('areas', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id  = htmlspecialchars($id);

        $area = $this->AreasModel->readById($id);

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id          = $_POST['id'];
            $nombre      = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $status      = $_POST['status'];

            $updateData = [
                'id'          => $id,
                'nombre'      => $nombre,
                'descripcion' => $descripcion,
                'status'      => $status,
            ];

            $rows = $this->AreasModel->update($updateData);

            Redirect::to(APP_URL . 'areas', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        $viewData = [
            'title'     => 'Áreas',
            'formTitle' => 'Editar Área',
            'data'      => [
                'fetchData' => $area,
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('areas', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->AreasModel->deleteById($id);

            Redirect::to(APP_URL . 'areas', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Áreas',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }

    public function obtenerAreasOptions($usuarioAreaId = ''): string
    {
        $areas = $this->AreasModel->readAllActive();

        $areasOptions = '';

        foreach ($areas as $area) {

            if (empty($usuarioAreaId)) {
                $areasOptions .= "
                <option value=\"{$area['id']}\">{$area['nombre']}</option>
                ";
            } else {
                $selected = ($usuarioAreaId == $area['id'])
                    ? 'selected'
                    : '';

                $areasOptions .= "
                <option value=\"{$area['id']}\" {$selected}>{$area['nombre']}</option>
                ";
            }
        }

        return $areasOptions;
    }
}
