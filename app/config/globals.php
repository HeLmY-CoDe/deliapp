<?php

DotEnv::load('./app/config/.env');

date_default_timezone_set('America/La_Paz');

/* echo '<pre>';
var_dump($_SERVER);
echo '</pre>'; */

function getAppURL()
{
    // Protocolo (http o https)
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    // Hostname (localhost o dominio en producción)
    $host = $_SERVER['HTTP_HOST'];

    // Ruta al script actual, sin el nombre del archivo
    $scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

    // Concatenar todo para obtener la URL base
    $appURL = $protocol . $host . $scriptDir . "/";

    return $appURL;
}

function getBasePath()
{
    // Obtenemos la ruta base del servidor
    $documentRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/\\');
    // Obtenemos la ruta del directorio del script
    $scriptDir = dirname($_SERVER['SCRIPT_NAME']);
    // Concatenamos y normalizamos las barras
    $basePath = $documentRoot . $scriptDir;

    // Aseguramos que la ruta termina con una barra
    return rtrim($basePath, '/\\') . '/';
}

define('DS', DIRECTORY_SEPARATOR);

# ------------------------- #

define('APP_URL', getAppURL());

define('BASE_PATH', getBasePath());

# ------------------------- #

define('PUBLIC_URL', APP_URL . 'public/');

define('ASSETS_URL', APP_URL . 'public/assets/');

define('VENDOR_URL', PUBLIC_URL . 'vendor/');

define('UPLOADS_URL', APP_URL . 'app/views/uploads/');

define('SCRIPTS_URL', APP_URL . 'app/views/scripts/');

# ------------------------- #

define('APP_PATH', BASE_PATH . 'app' . DS);

define('CORE_PATH', APP_PATH  . 'core' . DS);

define('MODELS_PATH', APP_PATH  . 'models' . DS);

define('CONTROLLERS_PATH', APP_PATH  . 'controllers' . DS);

define('VIEWS_PATH', APP_PATH . 'views' . DS);

define('LAYOUTS_PATH', VIEWS_PATH . 'layouts' . DS);

define('PAGES_PATH', VIEWS_PATH . 'pages' . DS);

define('MODULES_PATH', VIEWS_PATH . 'modules' . DS);

# ------------------------- #

define('DEFAULT_CONTROLLER', 'login');

define('DEFAULT_METHOD', 'index');


define('APP_NAME', 'DeliApp!');
define('APP_NAME_HTML', '<span class="text-primary">Deli</span><span class="text-danger">App</span><span class="text-white">!</span>');

// echo '<pre>';
// var_dump(APP_URL);
// echo '</pre>';

// echo '<pre>';
// var_dump(BASE_PATH);
// echo '</pre>';

// echo "<p>CONFIG OK!</p>";
