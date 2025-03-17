<?php

class ProductosController extends ProductosModel
{
    private $ProductosModel;

    public function __construct()
    {
        $this->ProductosModel = new ProductosModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerProductosTbody();

        $viewData = [
            'title'       => 'Productos',
            'moduleTitle' => 'Productos',
            'tbodyData'   => $tbodyData
        ];

        View::render('productos', 'index', $viewData);
    }

    private function obtenerProductosTbody(): string
    {
        $productos = $this->ProductosModel->readAll();

        $productosTbody = '';

        foreach ($productos as $producto) {

            $url = APP_URL . 'productos/';

            $estadoIcon = ($producto['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $productosTbody .= "
            <tr>
                <td class='text-center'>{$producto['id']}</td>
                <td class='text-center'>{$producto['codigo']}</td>
                <td>{$producto['detalle']}</td>
                <td class='text-center'>{$producto['seccion']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon} fs-5\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$producto['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$producto['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $productosTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        $SeccionesController = new SeccionesController();
        $seccionesOptions    = $SeccionesController->obtenerSeccionesOptions();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $codigo     = $_POST['codigo'];
            $detalle    = $_POST['detalle'];
            $seccion_id = $_POST['seccion_id'];
            $status     = $_POST['status'];

            $createData = [
                'codigo'     => $codigo,
                'detalle'    => mb_strtoupper($detalle),
                'seccion_id' => $seccion_id,
                'status'     => $status,
            ];

            $lastInsertId = $this->ProductosModel->create($createData);

            Redirect::to(APP_URL . 'productos', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Productos',
            'formTitle' => 'Nuevo Producto',
            'data'      => [
                'seccionesOptions' => $seccionesOptions,
            ],
            'alertMsg' => $alertMsg,
        ];

        View::render('productos', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id = htmlspecialchars($id);

        $producto = $this->ProductosModel->readById($id);

        if ($producto) {

            $SeccionesController = new SeccionesController();
            $seccionesOptions    = $SeccionesController->obtenerSeccionesOptions($producto['seccion_id']);
        }

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id         = $_POST['id'];
            $codigo     = $_POST['codigo'];
            $detalle    = $_POST['detalle'];
            $seccion_id = $_POST['seccion_id'];
            $status     = $_POST['status'];

            $updateData = [
                'id'         => $id,
                'codigo'     => $codigo,
                'detalle'    => mb_strtoupper($detalle),
                'seccion_id' => $seccion_id,
                'status'     => $status,
            ];

            $rows = $this->ProductosModel->update($updateData);

            Redirect::to(APP_URL . 'productos', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Productos',
            'formTitle' => 'Editar Producto',
            'data'      => [
                'fetchData'        => $producto,
                'seccionesOptions' => $seccionesOptions,
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('productos', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->ProductosModel->deleteById($id);

            Redirect::to(APP_URL . 'productos', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Productos',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }

    public function obtenerProductosOptions($productoId = ''): string
    {
        $productos = $this->ProductosModel->readAllActive();

        $productosOptions = '';

        foreach ($productos as $producto) {

            if (empty($productoId)) {
                $productosOptions .= "
                <option value=\"{$producto['id']}\">{$producto['codigo']} - {$producto['detalle']}</option>
                ";
            } else {
                $selected = ($productoId == $producto['id'])
                    ? 'selected'
                    : '';

                $productosOptions .= "
                <option value=\"{$producto['id']}\" {$selected}>{$producto['codigo']} - {$producto['detalle']}</option>
                ";
            }
        }

        return $productosOptions;
    }

    public function obtenerProductosSeccionOptions($seccion): string
    {
        $productos = $this->ProductosModel->readAllActiveBySeccion($seccion);

        $productosSeccionOptions = '';

        foreach ($productos as $producto) {

            $productosSeccionOptions .= "
            <option value=\"{$producto['id']}\">{$producto['codigo']} - {$producto['detalle']}</option>
            ";
        }

        return $productosSeccionOptions;
    }

    public function productoActivoPorId($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $this->ProductosModel->readActiveById($id)
                ? Response::jsonResponse(data: $this->ProductosModel->readActiveById($id))
                : Response::jsonResponse(404);
        }
    }
}
