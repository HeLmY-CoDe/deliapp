<?php

class Helpers
{
    public static function ok()
    {
        echo "<p>HELPERS OK!</p>";
    }

    // Método para formatear una fecha
    public static function formatDate($date, $format = 'd/m/Y')
    {
        if ($date == null) {
            return '';
        }

        $datetime = new DateTime($date);
        return $datetime->format($format);
    }

    public static function formatDateISO($date)
    {
        $datetime = new DateTime($date);
        return $datetime->format('Y-m-d');
    }

    public static function formatDateTime($date)
    {
        $datetime = new DateTime($date);
        return $datetime->format('d/m/Y H:m:s');
    }

    public static function formatDateTimeISO($date)
    {
        $datetime = new DateTime($date);
        return $datetime->format('Y-m-d H:m:s');
    }

    public static function getCurrentDateISO()
    {
        return date("Y-m-d");
    }

    public static function getCurrentDateTimeISO()
    {
        return date("Y-m-d H:m:s");
    }

    public static function swalAlert($title = 'título', $text = 'texto', $icon = 'success',)
    {
        return "
        <script>
            Swal.fire({
                title: '{$title}',
                text: '{$text}',
                icon: '{$icon}',
                // allowOutsideClick: false,
                showConfirmButton: false,
                confirmButtonText: 'Aceptar'
            });
        </script>
        ";
    }

    public static function bsAlert($text = 'texto', $type = 'success', $isDismissible = true)
    {

        $dismissible = '';
        $btnClose    = '';

        if ($isDismissible) {
            $dismissible = 'alert-dismissible';
            $btnClose = '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        }

        return '
        <div class="alert alert-' . $type . ' ' . $dismissible . ' fade show text-center mb-0 mt-3" role="alert">
            ' . $text . '
            ' . $btnClose . '
        </div>
        ';
    }

    public static function formatNumberTwoDecimals($number): string
    {
        return number_format($number, 2, '.', '');
    }

    public static function debugPdoQuery(string $query, array $params): string
    {
        foreach ($params as $key => $value) {
            // Determinar el placeholder a usar
            $placeholder = is_string($key) ? ":$key" : "?";

            // Escapar valores según el tipo
            if (is_string($value)) {
                $escapedValue = "'" . addslashes($value) . "'";
            } elseif (is_null($value)) {
                $escapedValue = "NULL";
            } elseif (is_bool($value)) {
                $escapedValue = $value ? "1" : "0"; // Convertir booleanos a 1/0
            } else {
                $escapedValue = $value;
            }

            // Reemplazar un placeholder a la vez (soporte para valores repetidos)
            $query = preg_replace('/' . preg_quote($placeholder, '/') . '/', $escapedValue, $query, 1);
        }

        return $query;
    }

    public static function getPrimerDiaFechaISO($date = 'now')
    {
        $fecha = new DateTime($date);
        return $fecha->modify('first day of this month')->format('Y-m-d');
    }

    public static function getUltimoDiaFechaISO($date = 'now')
    {
        $fecha = new DateTime($date);
        return $fecha->modify('last day of this month')->format('Y-m-d');
    }
}
