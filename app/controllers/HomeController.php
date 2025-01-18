<?php

class HomeController
{
    public function index()
    {
        echo '<br>HOLA DESDE ' . __METHOD__;

        $viewData = [
            'title'   => 'HoMe',
            'message' => 'Bienvenido al Sistema!',
        ];

        View::render('home', 'index', $viewData);
    }
}

?>