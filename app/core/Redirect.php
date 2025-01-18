<?php

class Redirect
{
    # => Método estático para redirigir al usuario a una página determinada
    public static function to($location, $delay = 0)
    {
        // Si las cabeceras ya han sido enviadas, usa JavaScript y meta-refresh
        $url = (strpos($location, 'http') !== false) ? $location : APP_URL . $location;

        if ($delay === 0) {

            if (headers_sent()) {

                echo "
                <script type=\"text/javascript\">
                    window.location.href=\"{$url}\"
                </script>
                <noscript>
                    <meta http-equiv=\"refresh\" content=\"0;url={$url}\" />
                </noscript>
                ";
                exit;
            }

            // Si la URL es externa, no tiene 'http', se redirige de manera directa
            if (strpos($location, 'http') !== false) {
                header('Location: ' . $location);
            } else {
                header('Location: ' . APP_URL . $location);
            }

            exit;
        }

        // Si las cabeceras ya han sido enviadas, usa JavaScript y meta-refresh
        if (headers_sent()) {
            echo "
            <script type=\"text/javascript\">
                setTimeout(function() {
                    window.location.href = \"{$url}\";
                }, " . ($delay * 1000) . ");
            </script>

            <noscript>
                <meta http-equiv=\"refresh\" content=\"{$delay};url={$url}\" />
            </noscript>
            ";
        } else {
            // Si las cabeceras no han sido enviadas, usa header con Refresh
            header("Refresh: {$delay}; url={$url}");
        }
    }
}
