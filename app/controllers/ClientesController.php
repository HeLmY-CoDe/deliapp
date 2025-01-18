<?php

class ClientesController
{
    private $ClientesModel;

    public function __construct()
    {
        $this->ClientesModel = new ClientesModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerClientesTbody();

        $viewData = [
            'title'       => 'Clientes',
            'moduleTitle' => 'Clientes',
            'tbodyData'   => $tbodyData
        ];

        View::render('clientes', 'index', $viewData);
    }

    private function obtenerClientesTbody(): string
    {
        $clientes = $this->ClientesModel->readAll();

        $clientesTbody = '';

        foreach ($clientes as $cliente) {

            $url = APP_URL . 'clientes/';

            $fechaNacimiento = Helpers::formatDate($cliente['fecha_nacimiento']);

            $estadoIcon = ($cliente['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $clientesTbody .= "
            <tr>
                <td class='text-center'>{$cliente['id']}</td>
                <td>{$cliente['nombres']}</td>
                <td>{$cliente['apellidos']}</td>
                <td class='text-center'>{$fechaNacimiento}</td>
                <td class='text-center'>{$cliente['celular']}</td>
                <td class='text-center'>{$cliente['email']}</td>
                <td class='text-center'>{$cliente['direccion']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon}\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$cliente['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$cliente['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $clientesTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombres          = $_POST['nombres'];
            $apellidos        = $_POST['apellidos'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $celular          = $_POST['celular'];
            $direccion        = $_POST['direccion'];
            $email            = $_POST['email'];
            $password         = $_POST['password'];
            $hash             = password_hash($password, PASSWORD_DEFAULT);
            $status           = $_POST['status'];

            $createData = [
                'nombres'          => $nombres,
                'apellidos'        => $apellidos,
                'fecha_nacimiento' => $fecha_nacimiento,
                'celular'          => $celular,
                'direccion'        => $direccion,
                'email'            => $email,
                'password'         => $hash,
                'status'           => $status,
            ];

            $lastInsertId = $this->ClientesModel->create($createData);

            Redirect::to(APP_URL . 'clientes', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Clientes',
            'formTitle' => 'Nuevo Cliente',
            'alertMsg'  => $alertMsg,
        ];

        View::render('clientes', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id = htmlspecialchars($id);

        $cliente = $this->ClientesModel->readById($id);

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id               = $_POST['id'];
            $nombres          = $_POST['nombres'];
            $apellidos        = $_POST['apellidos'];
            $fecha_nacimiento = $_POST['fecha_nacimiento'];
            $celular          = $_POST['celular'];
            $direccion        = $_POST['direccion'];
            $email            = $_POST['email'];
            $password         = $_POST['password'];
            $status           = $_POST['status'];

            $updateData = [
                'id'               => $id,
                'nombres'          => $nombres,
                'apellidos'        => $apellidos,
                'fecha_nacimiento' => $fecha_nacimiento,
                'celular'          => $celular,
                'direccion'        => $direccion,
                'email'            => $email,
                'status'           => $status,
            ];

            if ($password != '') {
                $updateData += ['password' => $password];
            }

            $rows = $this->ClientesModel->update($updateData);

            Redirect::to(APP_URL . 'clientes', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Clientes',
            'formTitle' => 'Editar Cliente',
            'data'      => [
                'fetchData' => $cliente,
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('clientes', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->ClientesModel->deleteById($id);

            Redirect::to(APP_URL . 'clientes', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Clientes',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }
}
