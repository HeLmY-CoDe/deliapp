<?php

class Alert
{
    public static function swal($title = 'título', $text = 'texto', $icon = 'success',)
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

    public static function bs5($text = 'texto', $type = 'success', $isDismissible = false)
    {

        $dismissible = 'pe-3';
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
}
