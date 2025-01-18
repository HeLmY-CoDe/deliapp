<?php

class LoginController extends LoginModel
{
    private $LoginModel;

    public function __construct()
    {
        $this->LoginModel = new LoginModel();
    }

    public function index()
    {
        $alertMsg = '';

        # Procesar solo si es una solicitud POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            # Obtener datos del formulario
            $nombreUsuario = $_POST['usuario'] ?? '';
            $password      = $_POST['password'] ?? '';

            # Validando si existe el Nombre de Usuario
            $dbUsuario = $this->LoginModel->usernameExists($nombreUsuario);

            if (!$dbUsuario) {
                $alertMsg = Alert::bs5('USUARIO NO REGISTRADO!', 'danger');
                return $this->renderLogin($alertMsg);
            }

            $nombreUsuario = $dbUsuario['nombre_usuario'];
            $estadoUsuario = $dbUsuario['status'];

            # Validando el Estado del Usuario
            if ($estadoUsuario != 1) {
                $alertMsg = Alert::bs5('USUARIO INACTIVO!', 'warning');
                return $this->renderLogin($alertMsg);
            }

            # Obteniendo y validando el Password considerando el Nombre de Usuario
            $dbPasswordHash = $this->LoginModel->getDBPassword($nombreUsuario);

            if (!$this->LoginModel->passwordVerify($password, $dbPasswordHash)) {
                $alertMsg = Alert::bs5('CONTRASEÑA INCORRECTA!', 'warning');
                return $this->renderLogin($alertMsg);
            }

            # Si la autenticación es exitosa
            $alertMsg = Alert::bs5('INICIANDO SESIÓN...', 'success');

            $this->LoginModel->initUserSession($nombreUsuario);
            Redirect::to(APP_URL . 'pages/menu', 2.5);

            return $this->renderLogin($alertMsg, true);
        }

        # Mostrar la vista si no es una solicitud POST
        $this->renderLogin($alertMsg);
    }

    # Método auxiliar para renderizar la vista
    private function renderLogin($alertMsg, $loginOK = false)
    {
        $viewData = [
            'title'    => 'Inicio de Sesión',
            'alertMsg' => $alertMsg
        ];

        $page = ($loginOK) ? 'message' : 'login';

        View::render('pages', $page, $viewData);
    }
}
