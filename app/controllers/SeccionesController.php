<?php

class SeccionesController extends SeccionesModel
{
    private $SeccionesModel;

    public function __construct()
    {
        $this->SeccionesModel = new SeccionesModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerSeccionesTbody();

        $viewData = [
            'title'       => 'Secciones',
            'moduleTitle' => 'Secciones',
            'tbodyData'   => $tbodyData
        ];

        View::render('secciones', 'index', $viewData);
    }

    public function obtenerSeccionesTbody(): string
    {
        $secciones = $this->SeccionesModel->readAll();

        $seccionesTbody = '';

        foreach ($secciones as $seccion) {

            $url = APP_URL . 'secciones/';

            $estadoIcon = ($seccion['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $seccionesTbody .= "
            <tr>
                <td class='text-center'>{$seccion['id']}</td>
                <td class='text-center'>{$seccion['nombre']}</td>
                <td class='text-center'>{$seccion['descripcion']}</td>
                <td class='text-center'>{$seccion['area']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon} fs-5\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$seccion['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$seccion['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $seccionesTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        $AreasController = new AreasController();

        $areasOptions = $AreasController->obtenerAreasOptions();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombre      = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $area_id     = $_POST['area_id'];
            $status      = $_POST['status'];

            $createData  =  [
                'nombre'      => $nombre,
                'descripcion' => $descripcion,
                'area_id'     => $area_id,
                'status'      => $status,
            ];

            $lastInsertId = $this->SeccionesModel->create($createData);

            Redirect::to(APP_URL . 'secciones', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Secciones',
            'formTitle' => 'Nueva Sección',
            'data'      => [
                'areasOptions' => $areasOptions
            ],
            'alertMsg'  => $alertMsg,
        ];

        View::render('secciones', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id  = htmlspecialchars($id);

        $seccion = $this->SeccionesModel->readById($id);

        if ($seccion) {

            $AreasController = new AreasController();

            $areasOptions = $AreasController->obtenerAreasOptions($seccion['area_id']);
        }

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id          = $_POST['id'];
            $nombre      = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $area_id     = $_POST['area_id'];
            $status      = $_POST['status'];

            $updateData = [
                'id'          => $id,
                'nombre'      => $nombre,
                'descripcion' => $descripcion,
                'area_id'     => $area_id,
                'status'      => $status,
            ];

            $rows = $this->SeccionesModel->update($updateData);

            Redirect::to(APP_URL . 'secciones', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        $viewData = [
            'title'     => 'Secciones',
            'formTitle' => 'Editar Sección',
            'data'      => [
                'fetchData'    => $seccion,
                'areasOptions' => $areasOptions
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('secciones', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->SeccionesModel->deleteById($id);

            Redirect::to(APP_URL . 'secciones', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Secciones',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }

    public function obtenerSeccionesOptions($usuarioAreaId = ''): string
    {
        $secciones = $this->SeccionesModel->readAllActive();

        $seccionesOptions = '';

        foreach ($secciones as $seccion) {

            if (empty($usuarioAreaId)) {
                $seccionesOptions .= "
                <option value=\"{$seccion['id']}\">{$seccion['nombre']}</option>
                ";
            } else {
                $selected = ($usuarioAreaId == $seccion['id'])
                    ? 'selected'
                    : '';

                $seccionesOptions .= "
                <option value=\"{$seccion['id']}\" {$selected}>{$seccion['nombre']}</option>
                ";
            }
        }

        return $seccionesOptions;
    }
}
