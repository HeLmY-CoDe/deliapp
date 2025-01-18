<?php

class View
{
    private function __construct() {}

    public static function render($module, $view = 'index', $viewData = ['title' => 'Sin título'])
    {
        $viewFilePath = MODULES_PATH . $module . DS . $view . '.php';

        // echo "<p>VIEW PATH: $viewFilePath</p>";

        if (is_file($viewFilePath)) {

            if (is_file(VIEWS_PATH . 'scripts' . DS . $module . '.js')) {

                $viewData += [
                    'moduleScript' => '<script defer src="' . SCRIPTS_URL . $module . '.js"></script>'
                ];
            }

            extract($viewData, EXTR_PREFIX_ALL, 'view');

            require_once LAYOUTS_PATH . 'header.php';

            if (Session::verify() && $view != 'message' && $view != 'menu') {
                require_once LAYOUTS_PATH . 'sidebar.php';
            }

            require_once $viewFilePath;

            $viewModalsFilePath = MODULES_PATH . $module . DS . 'modals.php';

            if (is_file($viewModalsFilePath)) {
                require_once $viewModalsFilePath;
            }

            require_once LAYOUTS_PATH . 'footer.php';
        } else {
            echo "<p>VISTA NO ENCONTRADA!</p>";
        }
    }
}
