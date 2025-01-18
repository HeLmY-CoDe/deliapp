<?php

class PagesController
{
    public function index()
    {
        $viewData = [
            'title' => 'PAGE!!!'
        ];

        View::render(
            module: 'test',
            viewData: $viewData
        );
    }

    public function error404()
    {
        $alertMsg = Alert::bs5('<strong class="me-2">ERROR 404:</strong> Página no encontrada... :(', 'danger');

        $viewData = [
            'title'    => 'ERROR 404',
            'alertMsg' => $alertMsg
        ];

        View::render('pages', 'error', $viewData);
    }

    public function error403()
    {
        $alertMsg = Alert::bs5('<strong class="me-2">ERROR 403:</strong> ¡Accesso NO autorizado!', 'danger');

        $viewData = [
            'title'    => 'ERROR 403 Forbidden',
            'alertMsg' => $alertMsg
        ];

        View::render('pages', 'error', $viewData);
    }

    public function menu()
    {
        $viewData = [
            'title'   => 'Menú',
            'message' => 'Bienvenido al Sistema!!!'
        ];

        View::render('pages', 'menu', $viewData);
    }

    public function logout()
    {
        $alertMsg = Alert::bs5('CERRANDO SESIÓN...', 'info');

        $viewData = [
            'title'    => 'Logout',
            'alertMsg' => $alertMsg
        ];

        Session::logout();

        View::render('pages', 'message', $viewData);
    }
}
