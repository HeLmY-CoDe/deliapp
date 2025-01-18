<?php

class UsuariosController
{
    private $UsuariosModel;

    public function __construct()
    {
        $this->UsuariosModel = new UsuariosModel();
    }

    public function index()
    {
        $tbodyData = $this->obtenerUsuariosTbody();

        $viewData = [
            'title'       => 'Usuarios',
            'moduleTitle' => 'Usuarios',
            'tbodyData'   => $tbodyData
        ];

        View::render('usuarios', 'index', $viewData);
    }

    private function obtenerUsuariosTbody(): string
    {
        $usuarios = $this->UsuariosModel->readAll();

        $usuariosTbody = '';

        foreach ($usuarios as $usuario) {

            $url = APP_URL . 'usuarios/';

            $estadoIcon = ($usuario['status'] == 1)
                ? 'check-circle-fill text-success'
                : 'x-circle-fill text-danger';

            $usuariosTbody .= "
            <tr>
                <td class='text-center'>{$usuario['id']}</td>
                <td>{$usuario['nombres']}</td>
                <td>{$usuario['apellidos']}</td>
                <td>{$usuario['cod_empleado']}</td>
                <td>{$usuario['celular']}</td>
                <td class='text-center'>{$usuario['nombre_usuario']}</td>
                <td class='text-center'>{$usuario['cargo']}</td>
                <td class='text-center'>{$usuario['seccion']}</td>
                <td class='text-center'><i class=\"bi bi-{$estadoIcon} fs-5\"></i></td>
                <td class='actions text-center'>
                    <button class='btn btn-warning btn-sm' onclick=\"window.location.href='{$url}editar/{$usuario['id']}'\">
                        <i class=\"bi bi-pencil me-1\"></i> Editar
                    </button>
                    <button class='btn btn-danger btn-sm' onclick=\"validarEliminacion({$usuario['id']});\">
                        <i class=\"bi bi-trash me-1\"></i> Eliminar
                    </button>
                </td>
            </tr>
            ";
        }

        return $usuariosTbody;
    }

    public function nuevo()
    {
        $alertMsg = '';

        $CargosController    = new CargosController();
        $SeccionesController = new SeccionesController();

        $cargosOptions    = $CargosController->obtenerCargosOptions();
        $seccionesOptions = $SeccionesController->obtenerSeccionesOptions();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nombres       = $_POST['nombres'];
            $apellidos     = $_POST['apellidos'];
            $cod_empleado  = $_POST['cod_empleado'];
            $celular       = $_POST['celular'];
            $nombreUsuario = $_POST['nombre_usuario'];
            $password      = $_POST['password'];
            $hash          = password_hash($password, PASSWORD_DEFAULT);
            $seccion_id    = $_POST['seccion_id'];
            $cargo_id      = $_POST['cargo_id'];
            $status        = $_POST['status'];

            $createData = [
                'nombres'        => $nombres,
                'apellidos'      => $apellidos,
                'cod_empleado'   => $cod_empleado,
                'celular'        => $celular,
                'nombre_usuario' => $nombreUsuario,
                'password'       => $hash,
                'seccion_id'     => $seccion_id,
                'cargo_id'       => $cargo_id,
                'status'         => $status,
            ];

            $lastInsertId = $this->UsuariosModel->create($createData);

            Redirect::to(APP_URL . 'usuarios', 2.5);

            if ($lastInsertId > 0) {
                $alertMsg = Alert::bs5('¡REGISTRO REALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡NO SE PUDO GUARDAR EL REGISTRO!', 'danger') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Usuarios',
            'formTitle' => 'Nuevo Usuario',
            'data'      => [
                'cargosOptions'    => $cargosOptions,
                'seccionesOptions' => $seccionesOptions,
            ],
            'alertMsg' => $alertMsg,
        ];

        View::render('usuarios', 'create', $viewData);
    }

    public function editar($id = null)
    {
        $id = htmlspecialchars($id);

        $usuario = $this->UsuariosModel->readById($id);

        if ($usuario) {

            $SeccionesController = new SeccionesController();
            $seccionesOptions    = $SeccionesController->obtenerSeccionesOptions($usuario['seccion_id']);

            $CargosController    = new CargosController();
            $cargosOptions       = $CargosController->obtenerCargosOptions($usuario['cargo_id']);
        }

        $alertMsg = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id            = $_POST['id'];
            $nombres       = $_POST['nombres'];
            $apellidos     = $_POST['apellidos'];
            $cod_empleado  = $_POST['cod_empleado'];
            $celular       = $_POST['celular'];
            $nombreUsuario = $_POST['nombre_usuario'];
            $password      = $_POST['password'];
            $seccion_id    = $_POST['seccion_id'];
            $cargo_id      = $_POST['cargo_id'];
            $status        = $_POST['status'];

            $updateData = [
                'id'             => $id,
                'nombres'        => $nombres,
                'apellidos'      => $apellidos,
                'cod_empleado'   => $cod_empleado,
                'celular'        => $celular,
                'nombre_usuario' => $nombreUsuario,
                'seccion_id'     => $seccion_id,
                'cargo_id'       => $cargo_id,
                'status'         => $status,
            ];

            if ($password != '') {
                $updateData += ['password' => $password];
            }

            $rows = $this->UsuariosModel->update($updateData);

            Redirect::to(APP_URL . 'usuarios', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info') . '<hr>';
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ACTUALIZADO CORRECTAMENTE!', 'success') . '<hr>';
            }
        }

        # ------------------------- #

        $viewData = [
            'title'     => 'Usuarios',
            'formTitle' => 'Editar Usuario',
            'data'      => [
                'fetchData'        => $usuario,
                'seccionesOptions' => $seccionesOptions,
                'cargosOptions'    => $cargosOptions,
            ],
            'alertMsg' => $alertMsg,
            'id'       => $id,
        ];

        View::render('usuarios', 'update', $viewData);
    }

    public function eliminar($id = null)
    {
        $alertMsg = '';

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = htmlspecialchars($id);

            $rows = $this->UsuariosModel->deleteById($id);

            Redirect::to(APP_URL . 'usuarios', 2.5);

            if ($rows == 0) {
                $alertMsg = Alert::bs5('NINGÚN CAMBIO REALIZADO...', 'info');
            } else {
                $alertMsg = Alert::bs5('¡REGISTRO ELIMINADO CORRECTAMENTE!', 'danger');
            }

            # ------------------------- #

            $viewData = [
                'title'    => 'Usuarios',
                'alertMsg' => $alertMsg,
            ];

            View::render('pages', 'message', $viewData);
        }
    }
}
